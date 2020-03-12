import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';

@Injectable()
export class HttpService {
  uri = 'http://127.0.0.1:8080/api/';
  constructor(private http: HttpClient) { }

  getData() {
    const myHeaders = new HttpHeaders({'Authorization': 'Bearer ' + localStorage.getItem('auth_token')});
    return this.http.post(this.uri + 'getArticles', '_author=ivan', {headers: myHeaders})
  }


}
