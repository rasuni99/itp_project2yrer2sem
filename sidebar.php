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
        <li class="treeview">
         <a href="#">
            <i class="fa  fa-cogs "></i>
            <span>Expenses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
         <ul class="treeview-menu">
             <li><a href="expenses_cat_1.php"><i class="fa fa-circle-o"></i>New Expenses Category</a></li>
            <li><a href="add_new_expense.php"><i class="fa fa-circle-o"></i>New Expenses Type</a></li>
            <li><a href="mark_expenses.php"><i class="fa fa-circle-o"></i>Insert Expenses</a></li>
          </ul>
          </li>
    
        <li class="header">SALES</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-cogs "></i>
            <span>New Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="sale_invoice.php"><i class="fa fa-circle-o"></i>New Delivery Note</a></li>
            <li><a href="sale_invoice_real.php"><i class="fa fa-circle-o"></i>New Sales Invoice</a></li>
            <li><a href="sales_return.php"><i class="fa fa-circle-o"></i>New Sales Return</a></li>
             <li><a href="quotation.php"><i class="fa fa-circle-o"></i>New Quotation</a></li>
           		
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-cogs "></i>
            <span>View Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li><a href="locate_delivery_note.php"><i class="fa fa-circle-o"></i>View Delivery Note</a></li>
            <li><a href="locate_invoice.php"><i class="fa fa-circle-o"></i>View Sales Invoice</a></li>
            <li><a href="locate_return.php"><i class="fa fa-circle-o"></i>View Sales Return</a></li>
            
         	 		
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-cogs "></i>
            <span>Cancel Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li><a href="remove_delivery_note.php"><i class="fa fa-circle-o"></i>Cancel Delivery Note by #</a></li>
            <li><a href="remove_delivery_note_all.php"><i class="fa fa-circle-o"></i>Cancel Delivery Note</a></li>
             <li><a href="remove_return_note.php"><i class="fa fa-circle-o"></i>Cancel Return Note by #</a></li>
            <li><a href="remove_return_note_all.php"><i class="fa fa-circle-o"></i>Cancel Return Note</a></li>
           
            
         	 		
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
                        <li ><a href="pay_receipt.php"><i class="fa fa-circle-o"></i>New Receipt</a></li>
                        <li ><a href="pending_realizing.php"><i class="fa fa-circle-o"></i>Pending Customer Cheques</a></li>
                        <li ><a href="new_receipt.php"><i class="fa fa-circle-o"></i>Customer Out-standings</a></li>
                         <li ><a href="view_receipt.php"><i class="fa fa-circle-o"></i>View Receipt</a></li>
                      	
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
         if($type==5 || $type==6){?>
       
        <?php } ?>
        
          <li class="header">REPORTS</li>
       
         <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Accounts Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                         <li ><a href="sales_report.php"><i class="fa fa-circle-o"></i>Sales Report(VAT + NonVAT)</a></li>
                         <li ><a href="vat_invoice_report.php"><i class="fa fa-circle-o"></i>Sales Report(VAT)</a></li>
                         <li ><a href="total_expense_report.php"><i class="fa fa-circle-o"></i>All Expenses Report</a></li>
                         <li ><a href="cash_expenses.php"><i class="fa fa-circle-o"></i>Cash Expenses Report</a></li> 
                         <li ><a href="cheque_expenses.php"><i class="fa fa-circle-o"></i>Cheque Expenses Report</a></li>
			  <li ><a href="all_invoices.php"><i class="fa fa-circle-o"></i>All Invoices</a></li>
                        <li ><a href="all_delivery_notes.php"><i class="fa fa-circle-o"></i>All Delivery Notes</a></li>
                        <li ><a href="all_return_notes.php"><i class="fa fa-circle-o"></i>All Return Notes</a></li>
<li ><a href="incomplete_orders.php" target="_blank" ><i class="fa fa-circle-o"></i>Incompleted Delivery Notes</a></li>						
          </ul>
        </li>
         
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

