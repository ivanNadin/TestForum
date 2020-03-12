import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Router} from "@angular/router";

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  uri = 'http://127.0.0.1:8080/api';
  token;

  constructor(private http: HttpClient,private router: Router) { }

  login(username: string, password: string) {
    this.http.post(this.uri + '/login_check', {username: username,password: password})
      .subscribe((resp: any) => {
        this.router.navigate(['profile']);
        localStorage.setItem('auth_token', resp.token);

      })
  }

  logout() {
    localStorage.removeItem('auth_token');
  }

  public get logIn(): boolean {
    return (localStorage.getItem('token') !== null);
  }

  getUser() {
    const myHeaders = new HttpHeaders({'Authorization': 'Bearer ' + localStorage.getItem('auth_token')});
    return this.http.post(this.uri, {}, {headers: myHeaders})
  }
}
