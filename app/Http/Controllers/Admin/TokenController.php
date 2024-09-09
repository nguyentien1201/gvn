<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Token\StoreCustomerRequest;
use App\Http\Requests\Token\StoreTokenRequest;
use App\Http\Requests\Token\UpdateCustomerRequest;
use App\Http\Requests\Token\UpdateTokenRequest;
use App\Models\Token;
use App\Service\WooCommerceApiService;
use Illuminate\Http\Request;

class TokenController extends AdminController
{
    public function index(Request $request)
    {
        $tokens = Token::all();
        return view('admin.tokens.index', compact('tokens'));
    }

    public function create()
    {
        return view('admin.tokens.create');
    }

    public function store(StoreTokenRequest $request)
    {
        $token = new Token();
        $token->fill($request->all());
        try {
            $token->save();
            $wcApiService = new WooCommerceApiService($token);
            if (!$wcApiService->authorize()) {
                return redirect()->back()->withInput()->with('fail', __('token.token_fail'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', __('panel.fail'));
        }
        return redirect()->back()->with('success', __('panel.success'));
    }

    public function edit(Token $token)
    {
        return view('admin.tokens.edit', compact('token'));
    }

    public function update(Token $token, UpdateTokenRequest $request)
    {
        $token->fill($request->all());
        try {
            $wcApiService = new WooCommerceApiService($token);
            if (!$wcApiService->authorize()) {
                return redirect()->back()->withInput()->with('fail', __('token.token_fail'));
            }
            $token->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.tokens.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.tokens.index')->with('success', __('panel.success'));
    }

    public function destroy(Token $token)
    {
        try {
            $token->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.tokens.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.tokens.index')->with('success', __('panel.success'));
    }
}
