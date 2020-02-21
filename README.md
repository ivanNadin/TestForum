# TestForum
create user:
curl -X POST http://localhost:80/register -d _username=johndoe -d _email=doesss -d _password=test

get token:
curl -Xcurl -X POST -H "Content-Type: application/json" http://localhost/api/login_check -d '{"username":"johndoe","password":"test"}'

check token: 
curl -H "Authorization: Bearer [token]" http://localhost:80/api
