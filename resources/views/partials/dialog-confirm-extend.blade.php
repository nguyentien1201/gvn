<style>



    .pricing-table {
  display: flex;
  flex-flow: row wrap;
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  background: #ffffff;
}

.pricing-table .ptable-item {

  padding: 0 15px;
  margin-bottom: 30px;
}



.pricing-table .ptable-single {
  position: relative;
  width: 100%;
  overflow: hidden;
}

.pricing-table .ptable-header,
.pricing-table .ptable-body,
.pricing-table .ptable-footer {
  position: relative;
  width: 100%;
  text-align: center;
  overflow: hidden;
}

.pricing-table .ptable-status ,
.pricing-table .ptable-title,
.pricing-table .ptable-price,
.pricing-table .ptable-description,
.pricing-table .ptable-action {
  position: relative;
  width: 100%;
  text-align: center;
}

.pricing-table .ptable-single {
  background: #f6f8fa;
}

.pricing-table .ptable-single:hover {
  box-shadow: 0 0 10px #999999;
}

.pricing-table .ptable-header {
  margin: 0 30px;
  padding: 30px 0 45px 0;
  width: auto;
  background: #4f4fee;
}

.pricing-table .ptable-header::before,
.pricing-table .ptable-header::after {
  content: "";
  position: absolute;
  bottom: 0;
  width: 0;
  height: 0;
  border-bottom: 100px solid #f6f8fa;
}

.pricing-table .ptable-header::before {
  right: 50%;
  border-right: 250px solid transparent;
}

.pricing-table .ptable-header::after {
  left: 50%;
  border-left: 250px solid transparent;
}

.pricing-table .ptable-item.featured-item .ptable-header {
  background: #4caf50;
}

.pricing-table .ptable-item.premium-item .ptable-header {
  background: #f44336;
}
.pricing-table .ptable-status {
  margin-top: -30px;
}

.pricing-table .ptable-status span {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 30px;
  padding: 5px 0;
  text-align: center;
  color: #4caf50;
  font-size: 14px;
  font-weight: 300;
  letter-spacing: 1px;
  background: #FFD700;
}

.pricing-table .ptable-status span::before,
.pricing-table .ptable-status span::after {
  content: "";
  position: absolute;
  bottom: 0;
  width: 0;
  height: 0;
  border-bottom: 10px solid #4caf50;
}

.pricing-table .ptable-status span::before {
  right: 50%;
  border-right: 25px solid transparent;
}

.pricing-table .ptable-status span::after {
  left: 50%;
  border-left: 25px solid transparent;
}

.pricing-table .ptable-title h2 {
  color: #ffffff;
  font-size: 24px;
  font-weight: 300;
  letter-spacing: 2px;
}

.pricing-table .ptable-price h2 {
  margin: 0;
  color: #ffffff;
  font-size: 45px;
  font-weight: 700;
  margin-left: 15px;
}

.pricing-table .ptable-price h2 small {
  position: absolute;
  font-size: 18px;
  font-weight: 300;
  margin-top: 16px;
  margin-left: -15px;
}

.pricing-table .ptable-price h2 span {
  margin-left: 3px;
  font-size: 16px;
  font-weight: 300;
}

.pricing-table .ptable-body {
  padding: 20px 0;
}

.pricing-table .ptable-description ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

.pricing-table .ptable-description ul li {
  color: #2A293E;
  font-size: 14px;
  font-weight: 300;
  letter-spacing: 1px;
  padding: 7px;
  border-bottom: 1px solid #dedede;
}

.pricing-table .ptable-description ul li:last-child {
  border: none;
}

.pricing-table .ptable-footer {
  padding-bottom: 30px;
}

.pricing-table .ptable-action a {
  display: inline-block;
  padding: 10px 20px;
  color: #ffffff;
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 2px;
  text-decoration: none;
  background: #0d6efd;
}

.pricing-table .ptable-action a:hover {
  color: white;
  background: #0d6efd;
}

.pricing-table .ptable-item.featured-item .ptable-action a {
  color: white;
  background: #4caf50;
}

.pricing-table .ptable-item.featured-item .ptable-action a:hover {
  color: white;
  background: #4caf50;
}
.pricing-table .ptable-item.premium-item .ptable-action a {
  color: white;
  background: #f44336;
}

.pricing-table .ptable-item.premium-item .ptable-action a:hover {
  color: white;
  background: #f44336;
}
</style>
<div class="modal fade" id="confirmExtend" tabindex="-1" role="dialog" aria-labelledby="confirmExtendModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-lg modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmExtendModalLabel">Gia hạn dịch vụ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   <input type="hidden" id="sub_price_id" value="">
    <input type="hidden" id="product_id" value="">
<div class="container pb-3 mt-5 pt-3" style="background: #f9f9f9;">
            <div class="row">
            <div class="pricing-table">
            <div class="ptable-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <div class="ptable-title">
                    <h2>1 Tháng</h2>
                    </div>
                    <div class="ptable-price">
                    <h2 ><small>$</small><b id="monthly_price"></b><span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>
                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                        <a class="subscription" data-type="buy" data-month="1">Buy</a>
                    </div>
                </div>
                </div>
            </div>

            <div class="ptable-item featured-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <!-- <div class="ptable-status">
                    <span>Hot</span>
                    </div> -->
                    <div class="ptable-title">
                    <h2>6 Tháng</h2>
                    </div>
                    <div class="ptable-price">
                    <h2><small>$</small> <b id="six_month_price"></b><span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>


                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                    <a class="subscription"  data-type="buy" data-month="2">Buy</a>
                    </div>
                </div>
                </div>
            </div>

            <div class="ptable-item premium-item col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="ptable-single">
                <div class="ptable-header">
                    <div class="ptable-title">
                    <h2>1 năm</h2>
                    </div>
                    <div class="ptable-price">
                    <h2><small>$</small><b id="yearly_price"></b><span></span></h2>
                    </div>
                </div>
                <div class="ptable-body">
                    <div class="ptable-description">
                    <ul>


                    </ul>
                    </div>
                </div>
                <div class="ptable-footer">
                    <div class="ptable-action">
                        <a class="subscription" data-type="buy" data-month="3">Buy</a>
                    </div>
                </div>
                </div>
            </div>
            </div>

            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- <div id="confirmExtend" class="modal fade" tabindex="-1" role="modal" aria-labelledby="confirmExtendModalLabel" aria-hidden="true">

</div> -->


<script>
    $(document).ready(function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $('.ptable-action .subscription').click(function(e) {
            e.preventDefault();
            let id = $('#sub_price_id').val();
            let product_id = $('#product_id').val();
            let type = $(this).data('type');
            let month = $(this).data('month');
            $.ajax({
                url: "{{ route('api.update-subscription') }}",
                type: 'POST',
                data: {
                    subcription_id: id,
                    product_id: product_id,
                    type: type,
                    month: month
                },
                success: function(data) {
                    alert(data.message);
                    $('#confirmExtend').modal('hide'); // Đóng modal

                }
            });
        });
    });
</script>
