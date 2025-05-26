<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

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

    // 비밀번호 재설정 요청
    public function passwordResetRequest(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => '비밀번호 재설정 링크가 이메일로 전송되었습니다.']);
        } else {
            return response()->json(['message' => '해당 이메일을 가진 사용자를 찾을 수 없습니다.'], 404);
        }
    }
    
    public function passwordReset(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'token' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'], // password_confirmation 필요!
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => '비밀번호가 성공적으로 변경되었습니다.']);
        } else {
            return response()->json(['message' => '비밀번호 재설정에 실패했습니다.'], 400);
        }
    }
    
}
