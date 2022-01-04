import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient, HttpHeaders} from '@angular/common/http';
import { map } from 'rxjs/operators';

const httpOptions = {
headers: new HttpHeaders({'Content-Type': 'Aplication/json'})
};
const apiURL = "http://localhost/webservice-ionic";


@Injectable({
  providedIn: 'root'
})
export class AuthServiceService {

  constructor(private http: HttpClient) { }
  Get_Data(type): Observable<any>{
    return this.http.get(`${apiURL}/${type}`);
  }
  Post_Data(type,credentials): Observable<any>{
    return this.http.post(`${apiURL}/${type}`,credentials,httpOptions);
  }
}
