import {Component, OnInit} from '@angular/core';
import {HttpService} from './http.service';
import {AuthService} from "./auth.service";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  providers: [HttpService],
  styleUrls: ['./app.component.sass']
})
export class AppComponent{

  constructor(private httpService: HttpService, private authService: AuthService) {
  }


  logout() {
    this.authService.logout();
  }
}
