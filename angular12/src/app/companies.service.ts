import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';



export class Companies {
  id!: number;
  company!: string;
}

const API_URL: string = 'http://localhost:8000';

@Injectable({
  providedIn: 'root'
})

export class CompaniesService {

  private accessToken:string = "testangularsymfony5@2022";


  constructor(private http: HttpClient) {}

  getCompanies(): Observable<any> {
    return this.http.get(API_URL + '/companies');
  }

  findCompanies(company:string,date:Date): Observable<any> {
    return this.http.get(API_URL + '/company/' + company + '/' + date);
  }

}
