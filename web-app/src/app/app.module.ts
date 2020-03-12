import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { AppComponent } from './app.component';
import {HttpClientModule} from "@angular/common/http";
import {LoginComponent} from "./login/login.component";
import {ProfileComponent} from "./profile/profile.component";
import {FormsModule} from "@angular/forms";
import { ArticlesComponent } from './articles/articles.component';
import { MessagesComponent } from './messages/messages.component';
import { RegistrationComponent } from './registration/registration.component';
import { ArticleFormComponent } from './articles/article-form/article-form.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    ProfileComponent,
    ArticlesComponent,
    MessagesComponent,
    RegistrationComponent,
    ArticleFormComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule,
    RouterModule.forRoot([
      { path: '', redirectTo: '/', pathMatch: 'full' },
      { path: 'registration', component: RegistrationComponent },
      { path: 'login', component: LoginComponent },
      { path: 'profile', component: ProfileComponent },
      { path: 'articles', component: ArticlesComponent },
      { path: 'messages', component: MessagesComponent},
      {path: 'article/:id', component: ArticleFormComponent},



    ]),
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
