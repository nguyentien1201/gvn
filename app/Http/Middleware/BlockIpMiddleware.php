<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\BanIp;
use Illuminate\Support\Facades\Cache;
class BlockIpMiddleware
{
    /**
     * Danh sách các địa chỉ IP bị chặn.
     */
    protected $blockedIps = [];

    /**
     * Xử lý yêu cầu HTTP.
     */
    public function handle(Request $request, Closure $next)
    {
        $blockedIps = $this->getBannedIpsFromCache();
        if (in_array($request->ip(), $blockedIps)) {
            // Nếu IP bị chặn, trả về phản hồi lỗi
            return response()->json(['message' => 'Your IP is blocked.'], 403);
        }
        return $next($request);  // Tiếp tục xử lý yêu cầu nếu IP hợp lệ
    }
    protected function getBannedIpsFromCache()
    {
        return Cache::remember('banned_ips', 3600, function () {
            // Lấy danh sách IP từ bảng banIp và cache lại trong 1 giờ
            return BanIp::pluck('ip')->toArray();
        });
    }
}
