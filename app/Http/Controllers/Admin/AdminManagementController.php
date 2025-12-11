<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AdminManagementController extends Controller
{
    /**
     * Display a listing of admins
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'admin');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $admins = $query->withCount('products')->latest()->paginate(10)->withQueryString();
        $pendingCount = User::where('role', 'admin')->where('status', 'pending')->count();

        return view('admin.admin-management.index', compact('admins', 'pendingCount'));
    }

    /**
     * Display pending admin approvals
     */
    public function pending()
    {
        $pendingAdmins = User::where('role', 'admin')
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.admin-management.pending', compact('pendingAdmins'));
    }

    /**
     * Approve admin registration
     */
    public function approve(User $user)
    {
        if ($user->role !== 'admin') {
            return back()->with('error', 'Pengguna ini bukan admin.');
        }

        $user->update(['status' => 'active']);

        // TODO: Send notification email to admin

        return back()->with('success', 'Admin berhasil disetujui!');
    }

    /**
     * Reject admin registration
     */
    public function reject(User $user)
    {
        if ($user->role !== 'admin') {
            return back()->with('error', 'Pengguna ini bukan admin.');
        }

        // Delete the user
        $user->delete();

        // TODO: Send notification email to admin

        return back()->with('success', 'Pendaftaran admin ditolak dan dihapus.');
    }

    /**
     * Toggle admin status (active/inactive)
     */
    public function toggleStatus(User $user)
    {
        if ($user->role !== 'admin') {
            return back()->with('error', 'Pengguna ini bukan admin.');
        }

        $newStatus = $user->status === 'active' ? 'inactive' : 'active';
        $user->update(['status' => $newStatus]);

        $message = $newStatus === 'active' 
            ? 'Admin berhasil diaktifkan!' 
            : 'Admin berhasil dinonaktifkan!';

        return back()->with('success', $message);
    }

    /**
     * Reset admin password
     */
    public function resetPassword(User $user)
    {
        if ($user->role !== 'admin') {
            return back()->with('error', 'Pengguna ini bukan admin.');
        }

        $newPassword = Str::random(12);
        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        // TODO: Send email with new password

        return back()->with('success', "Password admin berhasil direset. Password baru: {$newPassword}");
    }

    /**
     * Delete admin
     */
    public function destroy(User $user)
    {
        if ($user->role !== 'admin') {
            return back()->with('error', 'Pengguna ini bukan admin.');
        }

        // Delete admin's avatar if exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Products will be cascade deleted due to foreign key constraint
        $user->delete();

        return redirect()->route('admin.admin-management.index')
            ->with('success', 'Admin beserta semua produknya berhasil dihapus!');
    }

    /**
     * Show form to create new admin
     */
    public function create()
    {
        return view('admin.admin-management.create');
    }

    /**
     * Store new admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'status' => 'active',
        ]);

        return redirect()->route('admin.admin-management.index')
            ->with('success', 'Admin baru berhasil ditambahkan!');
    }

    /**
     * Show edit form for admin
     */
    public function edit(User $user)
    {
        if (!in_array($user->role, ['admin', 'super_admin'])) {
            return back()->with('error', 'Pengguna ini bukan admin.');
        }

        return view('admin.admin-management.edit', compact('user'));
    }

    /**
     * Update admin
     */
    public function update(Request $request, User $user)
    {
        if (!in_array($user->role, ['admin', 'super_admin'])) {
            return back()->with('error', 'Pengguna ini bukan admin.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'nullable|in:admin,super_admin',
            'status' => 'nullable|in:active,inactive,pending',
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ];

        // Only update role if not editing self
        if ($user->id !== auth()->id() && isset($validated['role'])) {
            $data['role'] = $validated['role'];
        }

        // Only update status if not editing self
        if ($user->id !== auth()->id() && isset($validated['status'])) {
            $data['status'] = $validated['status'];
        }

        // Update password if provided
        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.admin-management.index')
            ->with('success', 'Admin berhasil diperbarui!');
    }
}
