import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';



export class Users {
  id!: number;
  nom!: string;
  role!: string;
  profession!: string;
  division!: string;
  token!: string;
  email!: string;
}

const API_URL: string = 'http://localhost:8000';

@Injectable({
  providedIn: 'root'
})

export class UserService {

  constructor(private http: HttpClient) {}

  getUsers(): Observable<any> {
    return this.http.get(API_URL + '/users');
  }
}
