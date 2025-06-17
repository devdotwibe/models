<ul class="nav nav-tabs new-tabs mb-3">
<li class="<?=
(isset($activeTab)&&in_array($activeTab,array('wallet')))?'active':''
?>"><a href="<?=SITEURL.'services-requested.php'?>">Buy Tokens</a></li>

<li class="<?=
(isset($activeTab)&&in_array($activeTab,array('withdrawal')))?'active':''
?>"><a href="<?=SITEURL.'user/withdrawal'?>">Withdrawal</a></li>

<li class="<?=
(isset($activeTab)&&in_array($activeTab,array('transaction-history')))?'active':''
?>"><a href="<?=SITEURL.'user/transaction-history'?>">Transaction History</a></li>

<li class="<?=
(isset($activeTab)&&in_array($activeTab,array('bankdetails')))?'active':''
?>"><a href="<?=SITEURL?>user/bankdetails/create.php">Bank Detail</a></li>

</ul>