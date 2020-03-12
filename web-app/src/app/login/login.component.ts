import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.sass']
})
export class LoginComponent implements OnInit {
  username = '';
  password = '';

  constructor(private authService: AuthService) {

  }
  Login() {
    console.log("you are logging in")
    this.authService.login(this.username, this.password)

  }

  ngOnInit() { }
}
