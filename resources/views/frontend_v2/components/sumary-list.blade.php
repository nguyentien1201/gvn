@push('styles')
   <style>

.card {
      border: 1px solid #e5e7eb;       /* xám nhạt */
      border-radius: .75rem;           /* bo góc mềm */
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      transition: transform .2s;
    }
    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .card-body {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 1.25rem;
    }

    /* tiêu đề */
    .card-title {
      font-size: .875rem;
      font-weight: 600;
      color: #111827;
      margin-bottom: .25rem;
    }
    .card-value {
      font-size: 1.5rem;
      font-weight: 700;
      line-height: 1;
    }
    .card-unit {
      font-size: .875rem;
      color: #6b7280;
      margin-left: .25rem;
      font-weight: 400;
    }

    /* vòng icon */
    .card-icon {
      width: 2rem;
      height: 2rem;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.5rem;
    }

    /* từng trạng thái màu */
    .icon-signal {
      background-color: #FEF3C7;  /* vàng nhạt */
      color: #D97706;             /* vàng đậm */
    }
    .icon-hold {
      background-color: #EFF6FF;  /* xanh dương nhạt */
      color: #1D4ED8;             /* xanh dương đậm */
    }
    .icon-profit {
      background-color: #DCFCE7;  /* xanh lá nhạt */
      color: #15803D;             /* xanh lá đậm */
    }
    .icon-cut {
      background-color: #FEE2E2;  /* đỏ nhạt */
      color: #DC2626;             /* đỏ đậm */
    }
   </style>
@endpush

<div class="row g-4 pt-lg-5">
      <!-- Signal Open -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div>
              <div class="card-title">{{__('base.Signal_Open')}}</div>
              <div>
                <span class="card-value text-warning">{{$list_signal['signal_open'] ?? 0}}</span>
                <span class="card-unit">{{__('base.Symbol')}}</span>
              </div>
            </div>
            <div class="card-icon icon-signal">
              <!-- bạn có thể thay SVG ở đây -->
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M1 8a.5.5 0 0 1 .5-.5H13.293l-3.147-3.146a.5.5 0 1 1 .708-.708l4 4a.498.498 0 0 1 .146.351v.006a.498.498 0 0 1-.146.35l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
            </div>
          </div>
        </div>
      </div>
      <!-- Hold -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div>
              <div class="card-title">{{__('base.HOLD')}}</div>
              <div>
                <span class="card-value text-primary">{{$list_signal['signal_hold'] ?? 0}}</span>
                <span class="card-unit">{{__('base.Symbol')}}</span>
              </div>
            </div>
            <div class="card-icon icon-hold">
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M5.5 3.5A.5.5 0 0 1 6 3h1a.5.5 0 0 1 .5.5v9A.5.5 0 0 1 7 13h-1a.5.5 0 0 1-.5-.5v-9zm4 0A.5.5 0 0 1 10 3h1a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-9z"/></svg>
            </div>
          </div>
        </div>
      </div>
      <!-- Take Profit BUY -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div>
              <div class="card-title">{{__('base.TakeProfitBuy')}}</div>
              <div>
                <span class="card-value text-success">{{$list_signal['signal_TakeProfitBUY'] ?? 0}}</span>
                <span class="card-unit">{{__('base.Symbol')}}</span>
              </div>
            </div>
            <div class="card-icon icon-profit">
              {{__('base.BUY')}}
            </div>
          </div>
        </div>
      </div>
      <!-- Cut Loss BUY -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div>
              <div class="card-title">{{__('base.CutLossBuy')}}</div>
              <div>
                <span class="card-value text-success">{{$list_signal['signal_CutLossBUY'] ?? 0}}</span>
                <span class="card-unit">{{__('base.Symbol')}}</span>
              </div>
            </div>
            <div class="card-icon icon-cut">
               {{__('base.BUY')}}
            </div>
          </div>
        </div>
      </div>
    </div>


