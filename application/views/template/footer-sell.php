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
    <!--Switchery [ OPTIONAL ]-->
    <script src='<?php echo base_url("assets/plugins/switchery/switchery.min.js"); ?>' ></script>

    <!--=================================================-->

</body>

<script type="text/javascript">
    $(document).ready(function(){

        $('#cat_list').load("<?php echo site_url('pos/load_cat');?>");
      $('#add_cart').click(function(){
          //var product_id    = $(this).data("productid");
          var product_id    = $('#item_id').val();
          var product_name  = $('#item_name').val();
          var product_price = $('#item_price_lbl').text();
          var quantity = $('#item_qty').val();
          var price_cat = $('input[type=radio][name=price_group]:checked').attr('id');
          //var quantity      = $('#' + product_id).val();
          $.ajax({
              url : "<?php echo site_url('pos/add_to_cart');?>",
              method : "POST",
              data : {product_id: product_id, product_name: product_name, product_price: product_price, quantity: quantity, price_cat: price_cat},
              success: function(data){
                  $('.detail_cart').html(data);
                  $('#item_id').val("");
                  $('#item_name').val("");
                  $('#item_price_lbl').text("0000.00");
                  $('#item_qty').val("");
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

      //Custom Price Switch
      var custom_price_switch = document.getElementById('custom_price_switch');
      new Switchery(custom_price_switch);
      $('#item_price_txt').prop('readonly', true);
      custom_price_switch.onchange = function() {
        if(custom_price_switch.checked){
            $('#item_price_txt').prop('readonly', false);
            $('input[type=radio][name=price_group]').prop('disabled', true && 'checked', false)
        }else{
            $('#item_price_txt').prop('readonly', true);
            $('input[type=radio][name=price_group]').prop('disabled', false && 'checked', false)
        }
      }

      //Load Items
      $(document).on('click','.item_cat', function(e){
        e.preventDefault();
        var cat_id = $(this).data("cat_id");
        //alert(cat_id);
        //$('#item_list').load("<?php echo site_url('pos/load_item');?>");
        $.ajax({
              url : "<?php echo site_url('pos/load_item');?>",
              method : "GET",
              data : {cat_id: cat_id},
              success: function(data){
                  $('#item_list').html(data);
              }
          });
      })

      $(document).on('click','.item-btn', function(){
        var item_id = $(this).data("item_id");
        $.ajax({
            url : "<?php echo site_url('pos/item_details');?>",
            method : "GET",
            data : {item_id: item_id},
            success: function(data){
                //$('#item_list').html(data);
                var details = $.parseJSON(data);
                //alert(details['item_price']);
                
                $('#item_id').val(details['item_details']['item_id']);
                $('#item_name').val(details['item_details']['item_name']);
                $('#item_price_txt').val(details['item_details']['item_price']);
                $('#item_price_lbl').text(details['item_details']['item_price']);

                for(var i in details['price_cat']){
                    $('<div class="radio"><input type="radio" name="price_group" class="magic-radio" value="'+ details["price_cat"][i]["price"] +'" id="'+ details["price_cat"][i]["price_cat_id"] +'" /><label for="'+ details["price_cat"][i]["price_cat_id"] +'">'+ details["price_cat"][i]["price_cat_desc"] +'</label></div>').appendTo('#price_cat_list');
                }
            }
        });
      });

        $('#itemModal').on('hidden.bs.modal', function () {
            $('#price_cat_list').empty();
        });

        //Price Category
        //$('input[type=radio][name=price_group]').change(function(){
        $(document).on('change','input[type=radio][name=price_group]', function(){
            console.log("Change Triggered");
            var price_value = $('input[type=radio][name=price_group]:checked').val();
            console.log(price_value);
            $('#item_price_txt').val(price_value);
            $('#item_price_lbl').text($('#item_price_txt').val());
        });

        $('#item_price_txt').change(function(){
            $('#item_price_lbl').text($('#item_price_txt').val());
        });

        //Order
        $('#order1').click(function(){
          //var order_type = $('#order_type').val();
          //var mob_no  = $('#mob_no').val();
          //var product_price = $(this).data("productprice");
          //var quantity      = $('#' + product_id).val();
            $.ajax({
              url : "<?php echo site_url('pos/order');?>",
              method : "POST",
              //data : {order_type: order_type, mob_no: mob_no},
              success: function(data){
                if(data == 1){
                    $.niftyNoty({
                        type: 'success',
                        icon : 'pli-exclamation icon-2x',
                        message : 'Successfull',
                        container : 'floating',
                        timer : 3000
                    });
                }
                else if(data == 0){
                    $.niftyNoty({
                        type: 'danger',
                        icon : 'pli-exclamation icon-2x',
                        message : 'Failed',
                        container : 'floating',
                        timer : 3000
                    });
                }
                else{
                    $.niftyNoty({
                        type: 'danger',
                        icon : 'pli-exclamation icon-2x',
                        message : 'Internal Error',
                        container : 'floating',
                        timer : 6000
                    });
                } 
              }
            });
        });
        
      //load cat
      /*$('#cat_list').load(function load_cat(){
          
          $.ajax({
              url : "<?php echo site_url('pos/load_cat');?>",
              method : "GET",
              success: function(data){
                  $('#cat_list').html(data);
              }
          });
      });*/
      

  });
</script>
</html>
