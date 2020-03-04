import {Component, OnInit} from '@angular/core';
import {HttpService} from './http.service';
import {Article} from './article';

@Component({
  selector: 'app-root',
  template: `<div>
                    <p>Посты пользователя: {{article?.article}}</p>
             </div>`,
  providers: [HttpService],
  styleUrls: ['./app.component.sass']
})
export class AppComponent implements OnInit {

  article: Article;

  constructor(private httpService: HttpService) {}

  ngOnInit() {

    this.httpService.getData().subscribe((data: Article) => this.article = data);
  }
}
