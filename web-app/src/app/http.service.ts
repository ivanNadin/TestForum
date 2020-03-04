import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';

@Injectable()
export class HttpService {

  constructor(private http: HttpClient) {
  }

  getData() {
    const myHeaders = new HttpHeaders().set('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1ODMxNDY1ODksImV4cCI6MTU4MzE3NjU4OSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoiaXZhbiJ9.qcOC48Dfc5fI5CUMMCDZVra7qnr6OYN76ukdHMdVopfoI59pglQJhfTmrZaeGjMx8d53AFZXpappisiUYAAXL97UWfnQPe4HeY9j9Owas4sv_t5ZVLwN6rs53trAiPMkLuc5pmnie5B1F9dq6YkJHOTeUJv4ffsk-DstbdqLAR_1CQq7zAJV6YJ1RersiYKWRTvDpnkydGWPS8yqxQmBBgx6pwM8Mxt2A2mJVKmRLtVf_kV97xAk2T_-VjpTLxybSpuZOLuKPp_PKM-IYyweM7hIay9vd2d26rk_yMgOZ7PYSG3oeBMpoj3gWzu0OzoMps-puiONNazV4jK7eyLx936miL9G05bb4LEYzzswbmLSlDndSrGYPdOg2vJaTqY3ClcH4Fujmh_vQ8Tsc40eQvm5maa0jbX4_dtVakx974aFpwzHcFAVB_yOGrZ6xpjpNAxd-rtqcjDhnNluKZ-MX1DMSik8XTd6urL202nCrIII06KrRnpqTZ5esUSnGQjYbJbf00yxVFRg7j-eniRwi0wG1afa9lWGcKeXl_DfK5MiIKKjpI-aTS9_Ghw7h4PVjBE6UpXQN2WA7eHwv5nuvqwI1EGqwO6qyr9_2wx7FXtskf2iiZNdTok4d77o_lPFBj3oo2VAqKRD4zENCgZScMBLGu-0h4MG_VuWPLZRiQM');
    return this.http.post('http://172.20.0.4:80/api/getArticles', '_author=ivan', {headers: myHeaders});
  }
}
