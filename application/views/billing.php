<link rel="stylesheet" 
href="<?php echo site_url('application/views/assets/colorbox/colorbox.css'); ?>" />
		<script src="<?php echo site_url('application/views/assets/colorbox/jquery.min.js'); ?>"></script>
		<script src="<?php echo site_url('application/views/assets/colorbox/jquery.colorbox.js'); ?>"></script>
		<script>
			$(document).ready(function(){

		
				$("#iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$("#iframex").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>

	<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="icon_genius"></i> Billing</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="./">Home</a></li>
						<li><i class="icon_genius"></i>Tables</li>
					</ol>
				</div>
			</div>
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
	<?php echo __get_error_msg(); ?>
					<h3 class="box-title" style="margin-top:0;"><a id="iframe" href="<?php echo site_url('wishlist/home/wishlist_add/'.$id); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Add Menu</a></h3>
                      <section class="panel">
                          <header class="panel-heading">
                              Billing
                          </header>

                          <div class="table-responsive">
						  <form method="POST">
                            <table  border=0 width=50%  >
                              <thead>
						<?php			
			
								  foreach($wishlist as $k => $v) {
									  $wname=$v -> wname;
									  $wstatus=$v -> wstatus;
									  $wtid=$v -> wtid;
									  $tname=$v -> tname;
									  $person=$v -> person;
								  }
							$wcount= count($wishlist);
							if($wcount==0){
										$wname="";
									  $wstatus="";
									  $wtid="";
									  $tname="";
									  $person="";
								
							}
							//if($wcount>0){  
						?>
                                <tr>
          <th>&nbsp;&nbsp;</th><th>Meja</th><th><?php echo $tname; ?></th><th></th></tr>
		  <tr><th>&nbsp;&nbsp;</th><th>Nama</th><th><?php echo $wname; ?>
		  <tr><th>&nbsp;&nbsp;</th><th>Person</th><th><?php echo $person; ?>
		  <input type=hidden name="wname" value="<?php echo $wname; ?>" ></th><th></th></tr>
         
          <th>&nbsp;&nbsp;</th><th>Status</th><th><?php echo __get_status($wstatus,1); ?></th><th></th></tr>
                                </tr>
								
							<?php //} ?>
                              </thead>
                              <tbody>
								  
		  
                              </tbody>
                            </table><br>
							
                            <table class="table">
                              <thead>
                                <tr>
          <th>Menu</th>
		  <th>Qty</th>
         <th>Harga</th>
		 <th>Discount</th>
		 <th>Total</th>
          <!--th>Status</th-->
                                </tr>
                              </thead>
                              <tbody>
								  
		  <?php
		  $t=0;
		  $tt=0;
		  foreach($wishlist as $k => $v) :
		  ?>
		
                                        <tr>
          
		  <td><input type=hidden name="wdid[]" value="<?php echo $v -> wdid; ?>" >
		  <input type=hidden name="harga[]" value="<?php echo $v -> wharga; ?>" >
		  <?php echo $v -> mname; ?></td>
		  <td><select name="qty[]" class="form-control">
		  <option><?php echo $v -> wqty;?></option>
		  <?php for($i=1;$i<30;$i++){ ?>
		  <option><?=$i;?></option>
		  <?php } ?>
		  <option>0</option>
		  </select></td>
		<td><?php echo $v -> wharga;?></td>
		<td>
		<input type="hidden" name="wdisc[]" value="<?php echo $v -> wdisc;?>">
		<?php echo $v -> wdisc;
		$total=($v -> wqty * $v -> wharga) - (($v -> wqty) * ($v -> wharga) * ($v -> wdisc) /100) ;
		$tt=$tt+$total;
		$tdis=$tt * $v->wdis /100;
		$tppn=$tt * $v->wppn /100;
		$totaldis=$tt-($tdis) - ($tppn);
		
		$t=$totaldis+$t;
		?> %
		
		</td>
		<td><?=$total;?></td>
          <!--td><?php echo __get_status($v -> wstatus,1); ?></td-->
		  <td>
              &nbsp;
          </td>
										</tr>
        <?php endforeach; ?>
		
                              </tbody>
			<tr><td>Before Tax</td><td></td><td></td><td></td><td><?=$tt;?></td></tr>					  
							  
							  
			<tr><td>Discount</td><td><input class="form-control" type="number" name="discc"value="<?=$v -> wdis;?>" ><p>%</p></td><td></td><td></td><td><?=$tdis;?></td></tr>					  
		<tr><td>PPN</td><td style="width:200px"><input class="form-control" type="number" name="ppn" value="<?=$v -> wppn;?>" ><p>%</p></td><td></td><td></td><td><?=$tppn;?></td></tr>					  
		<tr><td><input type=submit class="btn btn-danger" value=save >
		<a id="iframex" class="btn btn-primary" target=blank href="<?php echo site_url('wishlist/home/billing2/' . $v -> wid); ?>">Print </a>
		<a id="iframex" class="btn btn-danger" target=blank href="<?php echo site_url('wishlist/home/billing_approve/' . $v -> wid); ?>">Approve </a>
		</td><td></td><td></td><td></td><td><?=$v -> wtotalall;?></td></tr>
                            </table>							
							
			</form>				
							
                          </div>
                                <div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <?php echo $pages; ?>
                                    </ul>
                                </div>

                      </section>
                  </div>
              </div>
