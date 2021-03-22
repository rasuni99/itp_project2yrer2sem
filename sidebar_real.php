<?php


?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      
        <ul class="sidebar-menu" data-widget="tree">
             
     <li class="header">REGISTRATION</li>  
     <li class="treeview">
          <a href="#">
            <i class="fa  fa-cogs "></i>
            <span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="customer_register.php"><i class="fa fa-circle-o"></i>Individual Customer</a></li>
            <li><a href="company_register.php"><i class="fa fa-circle-o"></i>Company Customer</a></li>
           
        
          </ul>
         </li>
         
          <li class="treeview">
         <a href="#">
            <i class="fa  fa-cogs "></i>
            <span>Suppliers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         <ul class="treeview-menu">
            <li><a href="supplier_register.php"><i class="fa fa-circle-o"></i>Supplier</a></li>
            <li><a href="add_bank_account_supplier.php"><i class="fa fa-circle-o"></i>Supplier Bank Account</a></li>
          </ul>
          </li>
          
           <li class="treeview">
         <a href="#">
            <i class="fa  fa-cogs "></i>
            <span>Company</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         <ul class="treeview-menu">
            <li><a href="add_bank_account_company.php"><i class="fa fa-circle-o"></i>Company Bank Account</a></li>
        
          </ul>
        </li>
        
        <li class="treeview">
         <a href="#">
            <i class="fa fa-cogs"></i> <span>Item - Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                        <li ><a href="category1.php"><i class="fa fa-circle-o"></i>New Category 01</a></li>
                        <li ><a href="category2.php"><i class="fa fa-circle-o"></i>New Category 02</a></li>
                        <li ><a href="category3.php"><i class="fa fa-circle-o"></i>New Category 03</a></li>
                        <li ><a href="category4.php"><i class="fa fa-circle-o"></i>New Category 04</a></li>
                        <li ><a href="create_item.php"><i class="fa fa-circle-o"></i>Generate Item</a></li>
                        
          </ul> 
        </li>
     
        <li class="treeview">
            <a href="#">
            <i class="fa fa-cogs"></i> <span>Item - Row</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
                        <li ><a href="row_category1.php"><i class="fa fa-circle-o"></i>New Category 01</a></li>
                        <li ><a href="row_category2.php"><i class="fa fa-circle-o"></i>New Category 02</a></li>
                        <li ><a href="row_category3.php"><i class="fa fa-circle-o"></i>New Category 03</a></li>
                        <li ><a href="row_category4.php"><i class="fa fa-circle-o"></i>New Category 04</a></li>
                        <li ><a href="row_create_item.php"><i class="fa fa-circle-o"></i>Generate Item</a></li>          
          </ul>
            
        </li>
    
        <li class="header">SALES</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-cogs "></i>
            <span>Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="sale_invoice.php"><i class="fa fa-circle-o"></i>New Cash Invoice</a></li>
            <li><a href="rent_invoice.php"><i class="fa fa-circle-o"></i>New Credit Invoice</a></li>
            <li><a href="rent_invoice.php"><i class="fa fa-circle-o"></i>New TAX Invoice</a></li>
         	 		
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-cogs "></i>
            <span>Quotation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="start_job.php"><i class="fa fa-circle-o"></i>New Quotation</a></li>
          <li ><a href="view_jobs.php"><i class="fa fa-circle-o"></i>All Quotations</a></li>
		 		
          </ul>
        </li>
        
         
        
        
   
        
       <li class="header">PAYMENTS</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dollar"></i> <span>Payments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                        <li ><a href="all_credits.php"><i class="fa fa-circle-o"></i>New Receipt</a></li>
                        <li ><a href="pending_realizing.php"><i class="fa fa-circle-o"></i>Realizing Pending</a></li>	
                        	
          </ul>
        </li>
         <?php if($type==1 || $type==0){?>
        <li class="header">GRN</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dollar"></i> <span>Row Items to Stores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                        <li ><a href="grn_main.php"><i class="fa fa-circle-o"></i>New GRN</a></li>
                        <li ><a href="allgrns.php"><i class="fa fa-circle-o"></i>All GRNs</a></li>
                        
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dollar"></i> <span>Products to Stores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                        <li ><a href="grn_main_products.php"><i class="fa fa-circle-o"></i>New GRN</a></li>
                        <li ><a href="allgrns.php"><i class="fa fa-circle-o"></i>All GRNs</a></li>
                        
          </ul>
        </li>
        
         <?php  }  
         if($type==1 || $type==0){?>
       
        <?php } ?>
        
         <li class="header">REPORTS</li>
        
         <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Daily Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                         <li ><a href="view_today_receipts.php"><i class="fa fa-circle-o"></i>Today Receipts</a></li>
                          <li ><a href="day_sale_invoices.php"><i class="fa fa-circle-o"></i>Today Sale Invoices</a></li>
                          <li ><a href="day_rent_charges.php"><i class="fa fa-circle-o"></i>Today Rent Pay Invoices</a></li>
                          <li ><a href="day_rent_invoices.php"><i class="fa fa-circle-o"></i>Today Rent Invoices</a></li>	
          </ul>
        </li>
         
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Sale Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                         <li ><a href="income_report.php"><i class="fa fa-circle-o"></i>Income Report</a></li>
                         <li ><a href="all_credits.php"><i class="fa fa-circle-o"></i>All Creditors</a></li>      
			<li ><a href="view_all_receipts.php"><i class="fa fa-circle-o"></i>All Receipts</a></li>
                        <li ><a href="all_invoices.php"><i class="fa fa-circle-o"></i>All Sale Invoices</a></li>
                        <li ><a href="all_rent_invoices.php"><i class="fa fa-circle-o"></i>All Rent Invoices</a></li>   	
          </ul>
        </li>
          <?php if($type==1 || $type==0){?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Stock Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                         <li ><a href="income_report.php"><i class="fa fa-circle-o"></i>Income Report</a></li>
			<li ><a href="all_invoices.php"><i class="fa fa-circle-o"></i>Invoice Report</a></li>
                       	
          </ul>
        </li>
          <?php } ?>
       
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>