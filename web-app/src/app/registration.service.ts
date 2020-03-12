import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Router} from "@angular/router";

@Injectable({
  providedIn: 'root'
})
export class RegistrationService {
  uri = 'http://127.0.0.1:8080/';
  token;

  constructor(private http: HttpClient,private router: Router) { }

  registration(username: string, email: string, password: string) {
    this.http.post(this.uri + 'register', {username: username,email: email, password: password})
      .subscribe((resp: any) => {

        this.router.navigate(['login']);
      })
  }
}
