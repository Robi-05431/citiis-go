<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ============================================================
    // REGISTER
    // POST /api/auth/register
    // ============================================================
    public function register(Request $request): JsonResponse
    {
        // 1. Validasi input
        $validator = Validator::make($request->all(), [
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'no_hp'    => 'nullable|string|max:20',
            'role'     => 'nullable|in:wisatawan,pengelola',
            // role admin TIDAK bisa didaftarkan via API publik
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // 2. Simpan user baru
        $user = User::create([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'password_hash' => Hash::make($request->password),
            'no_hp'         => $request->no_hp,
            'role'          => $request->role ?? 'wisatawan', // default wisatawan
            'status'        => 'aktif',
        ]);

        // 3. Buat token Sanctum
        $token = $user->createToken('citiisgo-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'data'    => [
                'user'  => $this->formatUser($user),
                'token' => $token,
                'token_type' => 'Bearer',
            ],
        ], 201);
    }

    // ============================================================
    // LOGIN
    // POST /api/auth/login
    // ============================================================
    public function login(Request $request): JsonResponse
    {
        // 1. Validasi input
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // 2. Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // 3. Cek password
        if (!$user || !Hash::check($request->password, $user->password_hash)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        // 4. Cek status akun
        if ($user->status !== 'aktif') {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda tidak aktif. Hubungi admin CitiisGo.',
            ], 403);
        }

        // 5. Hapus token lama (opsional, agar tidak numpuk)
        $user->tokens()->delete();

        // 6. Buat token baru
        $token = $user->createToken('citiisgo-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data'    => [
                'user'       => $this->formatUser($user),
                'token'      => $token,
                'token_type' => 'Bearer',
            ],
        ], 200);
    }

    // ============================================================
    // LOGOUT
    // POST /api/auth/logout
    // Header: Authorization: Bearer {token}
    // ============================================================
    public function logout(Request $request): JsonResponse
    {
        // Hapus token yang sedang dipakai
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ], 200);
    }

    // ============================================================
    // GET PROFILE (data diri sendiri)
    // GET /api/auth/me
    // Header: Authorization: Bearer {token}
    // ============================================================
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Data profil berhasil diambil',
            'data'    => $this->formatUser($request->user()),
        ], 200);
    }

    // ============================================================
    // UPDATE PROFILE
    // PUT /api/auth/profile
    // Header: Authorization: Bearer {token}
    // ============================================================
    public function updateProfile(Request $request): JsonResponse
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'nama'         => 'sometimes|string|max:255',
            'no_hp'        => 'sometimes|nullable|string|max:20',
            'foto_profil'  => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password'     => ['sometimes', 'confirmed', Password::min(8)],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Update field yang dikirim
        if ($request->has('nama'))  $user->nama  = $request->nama;
        if ($request->has('no_hp')) $user->no_hp = $request->no_hp;

        // Handle upload foto profil
        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('foto-profil', 'public');
            $user->foto_profil = $path;
        }

        // Update password jika dikirim
        if ($request->has('password')) {
            $user->password_hash = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'data'    => $this->formatUser($user),
        ], 200);
    }

    // ============================================================
    // Helper: format data user untuk response JSON
    // ============================================================
    private function formatUser(User $user): array
    {
        return [
            'id'          => $user->id,
            'nama'        => $user->nama,
            'email'       => $user->email,
            'no_hp'       => $user->no_hp,
            'foto_profil' => $user->foto_profil
                                ? asset('storage/' . $user->foto_profil)
                                : null,
            'role'        => $user->role,
            'status'      => $user->status,
            'created_at'  => $user->created_at,
        ];
    }
}