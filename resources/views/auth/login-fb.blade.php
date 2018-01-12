<script>
	var state = <?php echo $state; ?>;
	var token = "<?php echo $token; ?>";
	if(state == 1){
    	localStorage.setItem('user-token', token);
    	window.close();
	}
    else{
    	localStorage.setItem('user-token', null);
    }
</script>