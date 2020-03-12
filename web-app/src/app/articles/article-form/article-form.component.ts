import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {MessagesService} from "../../messages.service";
import {AuthService} from "../../auth.service";

@Component({
  selector: 'app-article-form',
  templateUrl: './article-form.component.html',
  styleUrls: ['./article-form.component.sass']
})
export class ArticleFormComponent implements OnInit {
  comments;
  user;
  commentText;
  id;


  constructor(private messagesService: MessagesService, private _route: ActivatedRoute, private authService: AuthService) {}

  ngOnInit(): void {
    this.id = +this._route.snapshot.params['id'];
    this.messagesService.getMessages(this.id).subscribe(data => this.comments = data);
    this.authService.getUser().subscribe(data => {this.user = data});
  }

  sendComment() {
    this.messagesService.sendComment(this.user,this.commentText, this.id).subscribe();
  }
}
