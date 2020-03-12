import { Component, OnInit } from '@angular/core';
import {MessagesService} from '../messages.service'

@Component({
  selector: 'app-messages',
  template:
    `<div>
    <ul>
      <li *ngFor="let item of jsonAr">{{item.message}} {{item.user}} {{item.createData}}</li>
    </ul>
  </div>`,
  styleUrls: ['./messages.component.sass']
})
export class MessagesComponent implements OnInit {
  jsonAr;

  constructor(private httpService: MessagesService) {}

  ngOnInit(): void {
    this.httpService.getMessages(7).subscribe(data => this.jsonAr = data);
  }

}
