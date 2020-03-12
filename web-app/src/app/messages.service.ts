import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class MessagesService {

  constructor(private http: HttpClient) { }

  getMessages(articleId) {
    const myHeaders = new HttpHeaders({'Authorization': 'Bearer ' + localStorage.getItem('auth_token')});
    return this.http.post('http://172.20.0.4:80/api/getComments', {articleId: articleId}, {headers: myHeaders})
  }
  sendComment(userId, commentText, articleId) {
    const myHeaders = new HttpHeaders({'Authorization': 'Bearer ' + localStorage.getItem('auth_token')});
    return this.http.post('http://172.20.0.4:80/api/addComment', {userId: userId, message: commentText, articleId: articleId,}, {headers: myHeaders})
  }
}
