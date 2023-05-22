<style>

    .dataTables_info { margin-top: 0px !important;  }

</style>


<section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Log List</h1>                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href=" "><i class="fa fa-home"></i><strong>Log</strong></a>
                                    </li>
                                     
                                    <li class="active">
                                        User's Log List
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    
<div class="col-lg-12">
					
                    
                        <section class="box ">
                            <header class="panel_header">
                                <div class="title pull-left">Filter</div>
                                <div class="actions panel_actions pull-right">
                                
                                
                                
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                                    <i class="box_close fa fa-times"></i>
                                </div>
                            </header>
                            
                            <div class="content-body" style="padding-bottom:15px; padding-top:15px;" >
                          
                             
                             
                             
                             
                            
                             <div class=" "  >
                             
                             <form method="post" id="myForm" > <div class="row">
                                     
                            
                              
                             
                            
                             
                            
                            
                            <div class="col-md-2 col-sm-2 col-xs-2"> 
                            
                            
                            
                           <?php $u_id = set_value('user'); ?>
                            
                            
                            User : <select class=" " name="user" id="branch">
                                           
                                           
                                           <option value="0">All</option>      
                                                  
                                             <?php foreach ($user->result() as $id => $user) : ?>
                                    <option value="<?php echo $user->user_id ?>" <?php echo $user->user_id == $u_id ? ' selected="selected"' : ''; ?> ><?php echo $user->username ?></option>
                                <?php endforeach; ?>  
                                
                                
                                
                                        </select>
                                        
                                         
                            
                            </div>



                                     <div class="col-md-2 col-sm-2 col-xs-2">



                                         <?php $date = set_value('date'); ?>


                                         Date : <div class='input-group  ' ><input type="text" placeholder="MM-DD-YYY" autocomplete="off"  value="<?php echo set_value('date'); ?>" class="form-control  datepicker "    name="date"   id=" "> <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>

                                         </div>



                                     </div>


                             <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;">

                                 <button type="submit" class="btn btn-success">     <i class="bSearch fa fa-search "></i> Search</button>

                                 &nbsp;
                                 <button type="button" class="btn btn-purple   " id='btnPrint'>

                                     <i class="fa fa-print" ></i>&nbsp;
                                     <span>Print</span>

                                 </button>
                            
                            </div>
                            
                            
                            </div>
                            <br />
                            
                          
                                    
                                    
                                     </form>
                             </div>
                             
                             </div>
                            
                            
                            
                            </section></div>

                    

                    <div class="col-lg-12">
					
					<?php  //var_dump(say_hello());  ?>
					
					

                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Log Details</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                                    <i class="box_close fa fa-times"></i>
                                </div>
                            </header>
                            <div id="dvContents" class="content-body" style="background:#f5f5f5">    <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">



                                        <!-- ********************************************** -->


                                        <table id="examples"  style="font-size:11px;"  class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>User</th>
                                                    <th>Description</th>
                                                    <th>Log Time </th>
                                                      <th>IP Address</th>
                                                      <th>Browser</th>
                                                       
                                                </tr>
                                            </thead>

                                            <tbody>
                                                
                                                 
                                                 
                                                 
                                                 
                                         <?php $x=0; foreach($activity->result() as $id => $activity) : $x++ ?>           
                                                 
                                                 
                                                 
                                                 
                                                 
                                               
                                               
                                                 
                                                <tr>
                                                    <td> <?php echo $x; ?> </td>
                                                    <td> <?php echo $activity->username; ?></td>
                                                    <td> <?php echo $activity->description; ?>  </td>
                                                    <td>  <?php echo $activity->log_date; ?> </td>
                                                     <td>  <?php echo $activity->from_ip; ?> </td>
                                                     <td>  <?php echo $activity->browser; ?> </td>
                                                       
                                                      
                                                      
                                                       
                                                </tr>
                                                
                                                <?php  endforeach ?>
                                            </tbody>
                                        </table>
                                        <!-- ********************************************** -->




                                    </div>
                                </div>
                            </div>
                        </section></div>



                    



                </section>
            </section>






<script src="<?php echo base_url() ?>resources/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/viewport/viewportchecker.js" type="text/javascript"></script>
<!-- CORE JS FRAMEWORK - END -->

<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/js/form-validation.js" type="text/javascript"></script>
        <!-- Sidebar Graph - END -->


<script src="<?php echo base_url() ?>resources/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script><script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script><script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script><script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>


<!-- CORE TEMPLATE JS - START -->
<script src="<?php echo base_url() ?>resources/js/scripts.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->

<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>
<!-- Sidebar Graph - END -->


<script>




    $(function(){
        $('#myForm').submit(function() {


            $('.bSearch').addClass('fa fa-spinner fa-spin');

            //  $('#search_load').html("<img src='<?php echo base_url() ?>resources/images/ajax-loader.gif'>");


            return true;
        });
    });



</script>


 <script type="text/javascript">
        $(function () {
            $("#btnPrint").click(function () {
                var contents = $("#dvContents").html();
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                 
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.open();
                //Create a new HTML document.
                frameDoc.document.write('<html><head><title>DIV Contents</title>');
                frameDoc.document.write('</head><body>');
                //Append the external CSS file.
				
				frameDoc.document.write('<link href="<?php echo base_url() ?>resources/css/style.css" rel="stylesheet" type="text/css" />');
				
				
                frameDoc.document.write('<link href="<?php echo base_url() ?>resources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />');
				
				frameDoc.document.write('<link href="<?php echo base_url() ?>resources/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />');
				
					frameDoc.document.write('<link href="<?php echo base_url() ?>resources/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />');
                
				frameDoc.document.write('<link href="<?php echo base_url() ?>resources/css/animate.min.css" rel="stylesheet" type="text/css" />');
				
				frameDoc.document.write('<link href="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css" />');
				
				frameDoc.document.write('<link href="<?php echo base_url() ?>resources/plugins/jquery-ui/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />');
				
				
				frameDoc.document.write('<link href="<?php echo base_url() ?>resources/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />');
				
				
				
				
				
				
				frameDoc.document.write('<link href="<?php echo base_url() ?>resources/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />');
				
				
				
				frameDoc.document.write('<link href="<?php echo base_url() ?>resources/css/responsive.css" rel="stylesheet" type="text/css" />');
				frameDoc.document.write('<link href="<?php echo base_url() ?>resources/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" />');
				
				frameDoc.document.write('<link href="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />');
				
				frameDoc.document.write('<link href="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />');
				//Append the DIV contents.
                frameDoc.document.write(contents);
                frameDoc.document.write('</body></html>');
                frameDoc.document.close();
                setTimeout(function () {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    frame1.remove();
                }, 500);
            });
        });
        
        
        
         $(document).ready(function () {
    
   
    
    $('#examples').DataTable({
        order: [[2, 'desc']],
    });
});

    </script>