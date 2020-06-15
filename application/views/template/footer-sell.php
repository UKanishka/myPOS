<!-- FOOTER -->
        <!--===================================================-->
        <footer id="footer">

            <!-- Visible when footer positions are fixed -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <div class="show-fixed pad-rgt pull-right">
                You have <a href="#" class="text-main"><span class="badge badge-danger">3</span> pending action.</a>
            </div>

            <!-- Visible when footer positions are static -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <div class="hide-fixed pull-right pad-rgt">
                14GB of <strong>512GB</strong> Free.
            </div>

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- Remove the class "show-fixed" and "hide-fixed" to make the content always appears. -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <p class="pad-lft">&#0169; 2020 Uditha Kanishka</p>

        </footer>
        <!--===================================================-->
        <!-- END FOOTER -->

        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->

    <!--JAVASCRIPT-->
    <!--=================================================-->
    <!--jQuery [ REQUIRED ]-->
    <script src='<?php echo base_url("assets/js/jquery.min.js"); ?>' ></script>
    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src='<?php echo base_url("assets/js/bootstrap.min.js"); ?>' ></script>
    <!--NiftyJS [ RECOMMENDED ]-->
    <script src='<?php echo base_url("assets/js/nifty.min.js");?>' ></script>
    <!--=================================================-->

</body>

<script type="text/javascript">
    $(document).ready(function(){
      $('#add_cart').click(function(){
          //var product_id    = $(this).data("productid");
          var product_id    = $('#item_id').val();
          var product_name  = $('#item_name').val();
          var product_price = $('input[type=radio][name=price_group]').val();
          var quantity = $('#item_qty').val();
          //var quantity      = $('#' + product_id).val();
          $.ajax({
              url : "<?php echo site_url('pos/add_to_cart');?>",
              method : "POST",
              data : {product_id: product_id, product_name: product_name, product_price: product_price, quantity: quantity},
              success: function(data){
                  $('.detail_cart').html(data);
              }
          });
      });
       
      $('.detail_cart').load("<?php echo site_url('pos/load_cart');?>");

       
      $(document).on('click','.romove_cart',function(){
          var row_id=$(this).attr("id"); 
          $.ajax({
              url : "<?php echo site_url('pos/delete_cart');?>",
              method : "POST",
              data : {row_id : row_id},
              success :function(data){
                  $('.detail_cart').html(data);
              }
          });
      });

      $('#order').click(function(){
          var order_type = $('#order_type').val();
          var mob_no  = $('#mob_no').val();
          //var product_price = $(this).data("productprice");
          //var quantity      = $('#' + product_id).val();
          $.ajax({
              url : "<?php echo site_url('pos/order');?>",
              method : "POST",
              data : {order_type: order_type, mob_no: mob_no},
              success: function(data){
                  //$('.detail_cart').html(data);
                  alert(data);
              }
          });
      });

      $('#btnSearch').click(function(){
        event.preventDefault();
        var sq = $("input[id='search']").val();
        $.ajax({
            url : "<?php echo base_url(); ?>order/search",
            type : "POST",
            method:"POST",
            datatype: "html",
            data : {searchQuery: sq},
            processData: true,
            contentType: false,
            error: function() {
              alert('Something is wrong');
            },
            success: function(data){
              //var resp = JSON.parse(data);
              $('#itemList').html(data);
            }
        });
      });

      $('input[type=radio][name=price_group]').change(function(){
        var price_value = $('input[type=radio][name=price_group]:checked').val();
        $('#item_price').text(price_value);
      })
  });
</script>
</html>
