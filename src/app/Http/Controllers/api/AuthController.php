<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 로그인 (세션 기반)
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 내부적으로 users 테이블에서 확인
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => '이메일 또는 비밀번호가 일치하지 않습니다.'], 401);
        }

        // 세션 재생성 (보안상 권장됨)
        $request->session()->regenerate();

        return response()->json(['message' => '로그인 성공']);
    }

    // 현재 로그인된 사용자 정보 반환
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    // 로그아웃
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => '로그아웃 되었습니다.']);
    }
}
