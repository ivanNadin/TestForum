import { Component, OnInit } from '@angular/core';
import {HttpService} from "../http.service";

@Component({
  selector: 'app-articles',
  templateUrl: './articles.component.html',
  styleUrls: ['./articles.component.sass']
})
export class ArticlesComponent implements OnInit {
  jsonAr;

  constructor(private httpService: HttpService) {}
  ngOnInit() {
    this.httpService.getData().subscribe(data => this.jsonAr = data);
  }
}
