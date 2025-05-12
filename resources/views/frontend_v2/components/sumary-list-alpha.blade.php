@push('styles')
   <style>

.card-icon {
    font-size: 0.75rem;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ccc; /* Viền mỏng */
    font-weight: bold;
  }

  .icon-green { background-color: #d1f7e4; color: #0f9d58; }
  .icon-red { background-color: #fde0e0; color: #e53935; }
  .icon-yellow { background-color: #fff3cd; color: #f9a825; }
  .icon-blue { background-color: #e0e7ff; color: #3f51b5; }

  .card-custom {
    border-radius: 10px;
    box-shadow: 0 0 5px rgba(0,0,0,0.05);
    padding: 20px;
    height: 100%;
  }

  .profit-value {
    font-size: 1.5rem;
    font-weight: bold;
  }

  .symbol-text {
    font-size: 0.9rem;
    color: #666;
  }

  .status-label {
    font-size: 0.8rem;
    font-weight: 600;
  }
  .card-custom {
  border-radius: 10px;
  border: 1px solid #e0e0e0; /* 👈 Viền nhẹ */
  box-shadow: 0 0 5px rgba(0,0,0,0.02);
  padding: 20px;
  height: 100%;
}
   </style>
@endpush

<div class="row g-3 pb-3">
    <!-- Highest Profit -->
    <div class="col-md-3 col-sm-6">
      <div class="card-custom bg-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="status-label">Highest Profit</div>
            <div class="profit-value text-success">{{$list_signal['highest_profit'] ?? 0}}</div>
            <div class="symbol-text">{{$list_signal['highest_profit_code'] ?? 0}}</div>
          </div>
          <div class="card-icon icon-green">📈</div>
        </div>
      </div>
    </div>

    <!-- Lowest Profit -->
    <div class="col-md-3 col-sm-6">
      <div class="card-custom bg-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="status-label">Lowest Profit</div>
            <div class="profit-value text-danger">{{$list_signal['lowest_profit'] ?? 0}}</div>
            <div class="symbol-text">{{$list_signal['lowest_profit_code'] ?? 0}}</div>
          </div>
          <div class="card-icon icon-red">📉</div>
        </div>
      </div>
    </div>

    <!-- Open Trade -->
    <div class="col-md-3 col-sm-6">
      <div class="card-custom bg-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="status-label">Open Trade</div>
            <div class="profit-value text-warning">{{$list_signal['buy_count'] ?? 0}}</div>
            <div class="symbol-text">Symbol</div>
          </div>
          <div class="card-icon icon-yellow">✏️</div>
        </div>
      </div>
    </div>

    <!-- Hold -->
    <div class="col-md-3 col-sm-6">
      <div class="card-custom bg-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="status-label">Hold</div>
            <div class="profit-value text-primary">{{$list_signal['buy_count'] ?? 0}}</div>
            <div class="symbol-text">Symbol</div>
          </div>
          <div class="card-icon icon-blue">⏸️</div>
        </div>
      </div>
    </div>

    <!-- Take Profit BUY -->
    <div class="col-md-3 col-sm-6">
      <div class="card-custom bg-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="status-label">Take Profit BUY</div>
            <div class="profit-value text-success">{{$list_signal['signal_close_types']['TakeProfitBUY'] ?? 0}}</div>
            <div class="symbol-text">Symbol</div>
          </div>
          <div class="card-icon icon-green">BUY</div>
        </div>
      </div>
    </div>

    <!-- Take Profit SELL -->
    <div class="col-md-3 col-sm-6">
      <div class="card-custom bg-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="status-label">Take Profit SELL</div>
            <div class="profit-value text-danger">{{$list_signal['signal_close_types']['TakeProfitSELL'] ?? 0}}</div>
            <div class="symbol-text">Symbol</div>
          </div>
          <div class="card-icon icon-red">SELL</div>
        </div>
      </div>
    </div>

    <!-- Cut Loss BUY -->
    <div class="col-md-3 col-sm-6">
      <div class="card-custom bg-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="status-label">Cut Loss BUY</div>
            <div class="profit-value text-success">{{$list_signal['signal_close_types']['CutLossBUY'] ?? 0}}</div>
            <div class="symbol-text">Symbol</div>
          </div>
          <div class="card-icon icon-green">BUY</div>
        </div>
      </div>
    </div>

    <!-- Cut Loss SELL -->
    <div class="col-md-3 col-sm-6">
      <div class="card-custom bg-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="status-label">Cut Loss SELL</div>
            <div class="profit-value text-danger">{{$list_signal['signal_close_types']['CutLossSELL'] ?? 0}}</div>
            <div class="symbol-text">Symbol</div>
          </div>
          <div class="card-icon icon-red">SELL</div>
        </div>
      </div>
    </div>
  </div>
