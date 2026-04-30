document.getElementById(loginform).addEventListener('submit',function(e)
{
    e.preventDefault();
    const email = document.getElementById('email').Value;
    const password = document.getElementById('password').value;
    console.log("Attempting login for: ", email);
    alert("Login logic triggered! check the console.");
});