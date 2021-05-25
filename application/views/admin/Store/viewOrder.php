  <?php
  if(isset($orderDetails) && !empty($orderDetails)){
      $productArray = [];
      foreach ($orderDetails as $OD) {
        $orders_id = $OD->orders_id;
        $account_id = $OD->account_id;
        $orders_time = $OD->orders_time;
        $ordering_method = $OD->ordering_method;
        $payment_method = $OD->payment_method;
        $orders_status = $OD->orders_status;
        $billing_name = $OD->billing_name;
        $billing_co_name = $OD->billing_co_name;
        $billing_address_1 = $OD->billing_address_1;
        $billing_address_2 = $OD->billing_address_2;
        $billing_city = $OD->billing_city;
        $billing_state = $OD->billing_state;
        $billing_zip = $OD->billing_zip;
        $billing_country = $OD->billing_country;
        $billing_tel = $OD->billing_tel;
        $billing_fax = $OD->billing_fax;
        $shipping_name = $OD->shipping_name;
        $shipping_co_name = $OD->shipping_co_name;
        $shipping_address_1 = $OD->shipping_address_1;
        $shipping_address_2 = $OD->shipping_address_2;
        $shipping_city = $OD->shipping_city;
        $shipping_state = $OD->shipping_state;
        $shipping_zip = $OD->shipping_zip;
        $shipping_country = $OD->shipping_country;
        $shipping_tel = $OD->shipping_tel;
        $shipping_email = $OD->shipping_email;
        $comment_ = $OD->comment_;
        $mod_date = $OD->mod_date;
        $Productname = $OD->name;
        $fedex_acc = $OD->fedex_number;
        $fedex_ser = $OD->fedex_delivery;
        $price = $OD->price;
        $catalog_num = $OD->catalog_num;
        $po_num = $OD->po_num;
        array_push($productArray, ['id'=> $OD->product_id, 'name' => $Productname,'catalog'=>  $catalog_num, 'price' => $price]);
        if(isset($orders_time)){
          $order_time = explode(' ', $orders_time); 
          $orderDate = $order_time[0];
          $orderTime = $order_time[1];
              }
        }
  }
  ?>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url();?>admin/dashboard/index">Dashboard</a></li>                    
    <li><a href="<?php echo base_url();?>admin/store/edit/products">Order Management</a></li>
    <li class="active">View Order</li>
  </ul>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-lg-12">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">Order Info</h3>
        </div>  
          <div class="panel-body">
              <div class="form-group">
            <label for="pcategory">Order # :</label>
              <?php echo isset($orders_id)?$orders_id:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">PO Number:</label>
              <?php echo isset($po_num)?$po_num:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Order Details:</label>
              <?php echo isset($orders_status)?$orders_status:'';?>
          </div>
          <?php foreach($productArray as $product => $value) { ?>
          <div class="form-group">
            <label for="pcategory">Product name:</label>
              <?php echo isset($value['name'])?$value['name']:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Catalog No:</label>
              <?php echo isset($value['catalog'])?$value['catalog']:'';?>
          </div>
          <?php $paid = $this->Order_Model->getOrderExtraDetails($orders_id,'tag',$value['id']);?>
          <div class="form-group">
            <label for="pcategory">Price:</label>
              <?php echo '$ '.$paid;?>
          </div>
          <div class="form-group">
            <label for="pcategory">Quantity:</label>
              <?php echo round($paid/$value['price']);?>
          </div>
          <?php } ?>
            
            <div class="form-group">
            <label for="pcategory">subtotal:</label>
              <?php echo isset($subtotal)?'$ '.$subtotal:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">shippingfee:</label>
              <?php echo isset($shippingfee)?'$ '.$shippingfee:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">tax:</label>
              <?php echo isset($tax)?$tax.'%':'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Fedex Account Number:</label>
              <?php echo isset($fedex_acc)?$fedex_acc:'';?>
          </div>
          <div class="form-group">
            <label for="pcategory">Fedex Service:</label>
              <?php echo isset($fedex_ser)?$fedex_ser:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">total:</label>
              <?php echo isset($total)?'$ '.$total:'';?>
          </div>
          
          </div>
        </div>
      </div>
    <div class="col-md-6 col-sm-6 col-lg-6">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">Billing Info</h3>
        </div>
          <div class="panel-body">
            <div class="form-group">
            <label for="pcategory">Billing Name:</label>
              <?php echo isset($billing_name)?$billing_name:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Billing Company Name:</label>
              <?php echo isset($billing_co_name)?$billing_co_name:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Address 1:</label>
              <?php echo isset($billing_address_1)?$billing_address_1:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Address 2:</label>
              <?php echo isset($billing_address_2)?$billing_address_2:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">City:</label>
              <?php echo isset($billing_city)?$billing_city:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">State:</label>
              <?php echo isset($billing_state)?$billing_state:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Zip:</label>
              <?php echo isset($billing_zip)?$billing_zip:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Country:</label>
              <?php echo isset($billing_country)?$billing_country:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Phone:</label>
              <?php echo isset($billing_tel)?$billing_tel:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Fax:</label>
              <?php echo isset($billing_fax)?$billing_fax:'';?>
          </div>
            <div class="form-group">

            <label for="pcategory">Date:</label>
              <?php echo isset($orderDate)?$orderDate:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Time:</label>
              <?php echo isset($orderTime)?$orderTime:'';?>
          </div>

          </div>
        </div>
      </div>
          <div class="col-md-6 col-sm-6 col-lg-6">
      <div class="panel panel-default">

        <div class="panel-heading">
          <h3 class="panel-title">Shipping Info</h3>
        </div>
          <div class="panel-body">
            <div class="form-group">
            <label for="pcategory">Name:</label>
              <?php echo isset($shipping_name)?$shipping_name:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">company Name:</label>
              <?php echo isset($shipping_co_name)?$shipping_co_name:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Address 1:</label>
              <?php echo isset($shipping_address_1)?$shipping_address_1:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Address 2:</label>
              <?php echo isset($shipping_address_2)?$shipping_address_2:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">City:</label>
              <?php echo isset($shipping_city)?$shipping_city:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">State:</label>
              <?php echo isset($shipping_state)?$shipping_state:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Zip:</label>
              <?php echo isset($shipping_zip)?$shipping_zip:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Country:</label>
              <?php echo isset($shipping_country)?$shipping_country:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Phone:</label>
              <?php echo isset($shipping_tel)?$shipping_tel:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Email:</label>
              <?php echo isset($shipping_email)?$shipping_email:'';?>
          </div>
            <div class="form-group">
            <label for="pcategory">Comment:</label>
              <?php echo isset($comment_)?$comment_:'';?>
          </div>
          </div>
        </div>
      </div>

    </div>
