import { Component, OnInit } from '@angular/core';
import {RegistrationService} from "../registration.service";

@Component({
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.sass']
})
export class RegistrationComponent implements OnInit {
  username = '';
  password = '';
  email = '';

  constructor(private registrationService: RegistrationService) { }
  Registration() {
    this.registrationService.registration(this.username, this.email, this.password)

  }
  ngOnInit(): void {
  }

}
