<?php

// app/Http/Controllers/UrlController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    // 处理短链生成请求
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        // 生成短码
        $shortCode = Str::random(6);

        // 保存到数据库
        $url = Url::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
        ]);

        return response()->json([
            'short_url' => url('/code/' . $shortCode)
        ]);
    }

    // 处理短链重定向
    public function redirect($code)
    {
        // 根据短码查询原始 URL
        $url = Url::where('short_code', $code)->firstOrFail();

        // 重定向到原始 URL
        return redirect()->to($url->original_url);
    }
}

