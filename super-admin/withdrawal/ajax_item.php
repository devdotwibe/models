<?php
if($all_data){
	foreach($all_data as $set_data){
?>
<tr>
<td><?=$set_data['id']?></td>
<td><?=$set_data['username']?></td>
<td>
<div class="d-flex justify-content-between mb-2">
<div><strong>Account Name:</strong></div>
<div><?=$set_data['account_name']?></div>
</div>

<div class="d-flex justify-content-between mb-2">
<div><strong>Account Number:</strong></div>
<div><?=$set_data['account_number']?></div>
</div>

<div class="d-flex justify-content-between mb-2">
<div><strong>Bank Name:</strong></div>
<div><?=$set_data['bank_name']?></div>
</div>

<div class="d-flex justify-content-between mb-2">
<div><strong>Branch Name:</strong></div>
<div><?=$set_data['branch_name']?></div>
</div>

<div class="d-flex justify-content-between ">
<div><strong>Address:</strong></div>
<div><?=$set_data['bank_address']?>, <?=print_value('countries',array('id'=>$set_data['country']),'name')?></div>
</div>
</td>
<td><?=$set_data['coins']?></td>
<td>$5</td>
<td><?=$set_data['amount']-5?></td>
<td><?=h_dateFormat($set_data['created_date'],'d-m-Y')?></td>
<td>
<?php
if($set_data['status']==1){
?>
<span class="badge badge-success">Paid</span>
<?php
}
else if($set_data['status']==2){
?>
<span class="badge badge-danger">Reject</span>
<?php
}
else{
?>
<a class="btn btn-xs btn-success" href="javascript:;" onclick="set_confirm(<?=$set_data['id']?>,'accept');">
 Confirm</a>
<a class="btn btn-xs btn-danger" href="javascript:;'" onclick="set_confirm(<?=$set_data['id']?>,'reject');">
 Reject</a>
<?php
}

?> 
</td>

</tr>

<?php
	}
}
else{
?>
<div class="p-4 text-center" ><h4>There is no withdrawal yet.</h4></div>
<?php	
}
?>
