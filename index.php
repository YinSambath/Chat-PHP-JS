<?php include_once "headerHTML.php"; ?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Chat Server</header>
            <form action="#" enctpye="multipart/form-data">
                <div class="error-text"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email Address" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" name="image" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Register">
                </div>
                <div class="link">Already singed up? <a href="login.php">Login now</a></div>
            </form>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
</body>
</html>