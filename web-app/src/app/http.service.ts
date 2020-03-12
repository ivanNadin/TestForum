import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';

@Injectable()
export class HttpService {

  constructor(private http: HttpClient) { }

  getData() {
    const myHeaders = new HttpHeaders({'Authorization': 'Bearer ' + localStorage.getItem('auth_token')});
    return this.http.post('http://172.20.0.4:80/api/getArticles', '_author=ivan', {headers: myHeaders})
  }


}
