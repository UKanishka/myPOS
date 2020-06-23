<style>
.item-btn{
    margin-top:5px;
    margin-right:5px;
}
</style>
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <div id="page-head">
        
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">POS</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
        <li><a href="#"><i class="demo-pli-home"></i></a></li>
        <li class="active">POS</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>

    
    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        
        <!-- <hr class="new-section-sm bord-no">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-body text-center">
                    <div class="panel-heading">
                        <h3>Your content here...</h3>
                    </div>
                    <div class="panel-body">
                        <p>Start putting content on grids or panels, you can also use different combinations of grids.
                        <br>Please check out the dashboard and other pages.</p>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-md-12 col-lg-2 eq-box-lg">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Category</h3>
                    </div>
                    <div class="panel-body">

                        <!--Extra Large-->
                        <!--===================================================-->
                        <div class="list-group" id="cat_list">
                            <a class="list-group-item list-item-xl" href="#"><b class="list-group-item-heading">Category 1</b><span class="badge badge-primary"><i class="fa fa-angle-double-right"></i></span></a>
                            <a class="list-group-item list-item-xl" href="#"><b class="list-group-item-heading">Category 2</b></a>
                            <a class="list-group-item list-item-xl" href="#"><b class="list-group-item-heading">Category 3</b></a>
                            <a class="list-group-item list-item-xl" href="#"><b class="list-group-item-heading">Category 4</b></a>
                        </div>
                        <!--===================================================-->

                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 eq-box-lg">
                <div class="panel">
                    <div class="panel-body">
                        <div class="input-group">
                            <input type="text" placeholder="Item Code" class="form-control input-lg">
                            <span class="input-group-btn">
                                <button class="btn btn-mint btn-lg" type="button">Search</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Items</h3>
                    </div>
                    <div class="panel-body">
                        <p id="item_list">
                        Select a category.
                        <!-- <button class="btn btn-lg btn-default item-btn" data-toggle="modal" data-target="#itemModal">Item 1</button>
                        <button class="btn btn-lg btn-default item-btn">Item 2</button>
                        <button class="btn btn-lg btn-default item-btn">Item 3</button>
                        <button class="btn btn-lg btn-default item-btn">Item 4</button>
                        <button class="btn btn-lg btn-default item-btn">Item 5</button>
                        <button class="btn btn-lg btn-default item-btn">Item 6</button>
                        <button class="btn btn-lg btn-default item-btn">Item 7</button>
                        <button class="btn btn-lg btn-default item-btn">Item 8</button>
                        <button class="btn btn-lg btn-default item-btn">Item 9</button>
                        <button class="btn btn-lg btn-default item-btn">Item 10</button>
                        <button class="btn btn-lg btn-default item-btn">Item 11</button>
                        <button class="btn btn-lg btn-default item-btn">Item 12</button>
                        <button class="btn btn-lg btn-default item-btn">Item 12</button>
                        <button class="btn btn-lg btn-default item-btn">Item 12</button> -->
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 eq-box-lg">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cart</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped" borders="0" style="">
                            <thead>
                                <tr>
                                    <th>Items</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th style="width:10px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="detail_cart" class="detail_cart">

                            </tbody>
                            
                        </table>
                        
                    </div>
                    <div class="panel-footer">
                        <button id="order1" class="order btn btn-block btn-success" data-toggle="modal" data-target="#orderTypeModal"><i class="fa fa-check-square-o">&nbsp;</i> Order</button>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
    <!--===================================================-->
    <!--End page content-->


<!-- Modals-->
<!-- Item Modal -->
<div id="itemModal" class="modal" role="dialog">
  <!-- Select2 -->
  <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add to Cart</h4>
          <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
        </div>
        <div class="modal-body">
            <div class="panel">	            
                <form>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" style="margin:0px 50px 50px 50px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="item_name">Item Name</label>
                                    <input id="item_name" type="text" class="form-control" readonly value="Item 1">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="item_qty">Quantity</label>
                                    <input id="item_qty" type="number" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Price Group</label>
                                    <div style="margin-left:20px;" id="price_cat_list">
                                        <!-- Expected Radio button -->
                                        <!--<div class="radio" hidden>
                                            <input id="demo-form-radio" class="magic-radio" type="radio" name="price_group" value="1200.00">
                                            <label for="demo-form-radio">Group 1</label>
                                        </div>-->
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    
                                    <label class="control-label" for="item_qty">Price &nbsp;</label>
                                    <input id="custom_price_switch" type="checkbox">
                                    <input id="item_price_txt" type="number" class="form-control text-right" placeholder="Rs.0000.00">
                                </div>
                                <div class="form-group text-right align-self-center">
                                    <h2>Rs.<span id="item_price_lbl">0000.00</span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <input id="item_id" value="" hidden>
          <button id="add_cart" type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-cart-plus">&nbsp;&nbsp;</i>Add to Cart</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>
<!-- -->
<!--End Modals-->

</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->
