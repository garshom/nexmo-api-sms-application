
</div>
</div>


<footer>
    <div class="navbar navbar-default navbar-static-top footer">
        <div class="copyright">
                <a href="#" target="_blank">&copy; SMS Inc  2017 - <?php echo date("Y"); ?></a> All rights reserved
        </div>
    </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="bootstrap/js/jquery-1.9.0.min.js"></script>
<script src="bootstrap/table/jquery.dataTables.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/table/dataTables.bootstrap.min.js"></script>


<script type="text/javascript">
$(document).ready(function() {	
	
	// submit form using $.ajax() method
	
	$('#send_msg_form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'process_sms.php',
			type: 'POST',
			data: $(this).serialize() // it will serialize the form data
		})
		.done(function(data){
			$('#success_msg').html(data);
			$('#sender_id').val("");
			$('#recepient_number').val("");
			$('#send_message').val("");
			
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	});
	
	$('#send_msg_form').submit(function(e){
		e.preventDefault();
		$.ajax({
			url: 'refresh_sent.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
		
			$('#message_recent_sent').html(data);
			
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	
	})
	// refresh credit balance stats
	$('#send_msg_form').submit(function(e){
		e.preventDefault();
		$.ajax({
			url: 'credit_update.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
		
			$('#load_credit_balance').html(data);
			
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	
	})
	
	// submit new user request;
	
	
	$('#create_user_form').submit(function(e){
		e.preventDefault();
		$.ajax({
			url: 'process_newuser.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
			$('#success_msg').html(data);
			$('#user_email').val("");
			$('#password').val("");
			
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	
	})
	
	$('#add_credit_form').submit(function(e){
		e.preventDefault();
		$.ajax({
			url: 'add_credit_form.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
			$('#success_msg').html(data);
			$('#credits_toadd').val("");
			
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	
	})
	
	// refresh credit balance stats
	$.ajax({
			url: 'credit_update.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
		
			$('#load_credit_balance').html(data);
			
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	
	// refresh sent message stats
	$.ajax({
			url: 'refresh_sent.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
			$('#message_recent_sent').html(data);		
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
		
	// Load Sent Messages 
	$.ajax({
			url: 'load_sent_messages.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
			$('#table_data').html(data);
			$('#example').DataTable();
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
		
		// Load Users Data 
	$.ajax({
			url: 'load_users.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
			$('#users_data').html(data);
			$('#users_example').DataTable();
			
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
		
		// Load all messages data 
		$.ajax({
			url: 'all_sent.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
			$('#table_data_all').html(data);
			$('#example_all').DataTable();
			
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
		
		// Load all roles drop down 
		$.ajax({
			url: 'load_roles.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
			$('#load_roles').html(data);
			
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
		
		// Load all usernames drop down 
		$.ajax({
			url: 'load_users_dropdown.php',
			type: 'POST',
			data: $(this).serialize() 
		})
		.done(function(data){
			$('#load_usernames').html(data);
			
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	
	// Textarea character count 
	  var text_max = 160;
	  $('#count_message').html(text_max + ' remaining');

	  $('#send_message').keyup(function() {
	  var text_length = $('#send_message').val().length;
	  var text_remaining = text_max - text_length;
	  $('#count_message').html(text_remaining + ' remaining');
	  });
	
});

</script>

</body>
</html>