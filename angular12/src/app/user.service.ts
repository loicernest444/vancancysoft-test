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

export class Role {
  id!: number;
  role!: string;
}

export class Profession {
  id!: number;
  profession!: string;
}

export class Division {
  id!: number;
  division!: string;
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

  getRoles(): Observable<any> {
    return this.http.get(API_URL + '/roles');
  }

  getProfessions(): Observable<any> {
    return this.http.get(API_URL + '/professions');
  }

  getDivisions(): Observable<any> {
    return this.http.get(API_URL + '/divisions');
  }

  getJobs(): Observable<any> {
    return this.http.get(API_URL + '/jobs');
  }

  getCompanies(): Observable<any> {
    return this.http.get(API_URL + '/companies');
  }

  findJobs(company:number,debut1:Date,fin1:Date): Observable<any> {
    return this.http.get(API_URL + '/job/' + company + '/' + debut1 + '/' + fin1);
  }

}
