import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class MessagesService {
  uri = 'http://127.0.0.1:8080/api/';
  constructor(private http: HttpClient) { }

  getMessages(articleId) {
    const myHeaders = new HttpHeaders({'Authorization': 'Bearer ' + localStorage.getItem('auth_token')});
    return this.http.post(this.uri +'getComments', {articleId: articleId}, {headers: myHeaders})
  }
  sendComment(userId, commentText, articleId) {
    const myHeaders = new HttpHeaders({'Authorization': 'Bearer ' + localStorage.getItem('auth_token')});
    return this.http.post(this.uri + 'addComment', {userId: userId, message: commentText, articleId: articleId,}, {headers: myHeaders})
  }
}
