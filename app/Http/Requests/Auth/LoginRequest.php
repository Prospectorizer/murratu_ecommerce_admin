<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'user_identity' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate($parameters): void
    {
        $this->ensureIsNotRateLimited();
        // if (! Auth::attempt(['mobile' => $parameters['mobile'],'password' => $parameters['password']], $this->boolean('remember'))) {
        // if (! Auth::attemptWhen(
        //         [
        //             // 'mobile' => $parameters['user_identity'],
        //             'password' => $parameters['password'],
        //         ],
        //         function (User $user) use($parameters){
        //             return $user->validateUserIdentity($parameters);
        //         },
        //         $this->boolean('remember')
        // )) {
        $user = (new User())->validateUserIdentity($parameters);
        $token = $user->createToken('access_token');
        Log::warning($token);
        Log::warning("token");
        if($user){
            if(Hash::check($parameters['password'],$user->password)){
                Auth::login($user);
                
                RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'user_identity' => trans('auth.failed'),
                    'password' => trans('auth.failed'),
                ]);
            }
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
