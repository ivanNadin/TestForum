import {Component, OnInit} from '@angular/core';
import {HttpService} from './http.service';
import {Article} from './article';

@Component({
  selector: 'app-root',
  template: `   <div>Hello mfucker</div>
                <div>
                    <p>Имя пользователя: {{article?.article}}</p>
               </div>`,
  providers: [HttpService],
  styleUrls: ['./app.component.sass']
})
export class AppComponent implements OnInit {
  title = 'HeroAngular';

  article: Article;

  constructor(private httpService: HttpService) {}

  ngOnInit() {

    this.httpService.getData().subscribe((data: Article) => this.article = data);
  }
}
