<?php 
    include 'head_common.php';
?>


<div class="signup-form">
    <h1>Sign Up</h1>
    <form class="form-signup" action="/stp/signup/sign" method="post">
        <label for="Email"> Email: <input type="text" placeholder="email " id="email" name="email"> </label> <br>
        <label for="UserName"> Username: <input type="text" placeholder="username " id="username" name="username"> </label> <br>
        <label for="Password"> Password: <input type="password" placeholder="password" id="password" name="password"> </label><br>
        
    <button type="submit">Sign In</button>
    </form>
</div>
    
<?php 
     include 'footer_common.php';
?>