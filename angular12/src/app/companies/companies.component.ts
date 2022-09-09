import { Component, OnInit } from '@angular/core';
//import { NgForm } from '@angular/forms';
import { Companies, CompaniesService } from '../companies.service';
//import 'rxjs/Rx';

@Component({
  selector: 'app-companies',
  templateUrl: './companies.component.html',
  styleUrls: ['./companies.component.css']
})
export class CompaniesComponent implements OnInit {

  companies!: Companies[];
  errorMessage!: string;
  isLoading: number = 1;
  page: number = 1;

  company!: string;
  date!: Date;

  constructor(private companiesService: CompaniesService) { }

  ngOnInit(): void {
    this.getCompanies()
  }

  getCompanies() {
    this.companiesService.getCompanies().subscribe(
      data => {
        this.companies = data;
        this.isLoading = 0;
      }
    )
  }

  findCompanies() {
    this.companiesService.findCompanies(this.company,this.date).subscribe(
      data => {
        this.companies = data
        this.isLoading = (this.company == undefined )?0:2;
      }
    )
  }

}
