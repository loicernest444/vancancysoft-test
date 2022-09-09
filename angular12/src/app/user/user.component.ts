import { Component, OnInit } from '@angular/core';
import { Role, Profession, Division, UserService } from '../user.service';
import { ElementRef, ViewChild } from '@angular/core';


import jsPDF from 'jspdf';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})

export class UserComponent implements OnInit {


  isLoading: boolean = true;
  roles!: Role[]; jobs!:any[]; companies!: any[];
  professions!: Profession[];
  divisions!: Division[];
  errorMessage!: string;
  page: number = 1;

  role: number = 536;
  profession: number = 1;
  division: number = 75;
  company:number = 11604;

  debut!: any;
  fin!: any;

  constructor(private userService: UserService) { }

  ngOnInit(): void {
    this.getRoles();
    this.getProfessions();
    this.getDivisions();
    this.getJobs();
    this.getCompanies();
  }

  getRoles(){
    this.userService.getRoles().subscribe(data => {
      this.roles = data;
    })
  }

  getProfessions(){
    this.userService.getProfessions().subscribe(data => {
      this.professions = data;
    })
  }

  getDivisions(){
    this.userService.getDivisions().subscribe(data => {
      this.divisions = data;
    })
  }

  getJobs(){
    this.userService.getJobs().subscribe(data => {
      this.jobs = data;
      this.isLoading = false;
    })
  }

  getCompanies(){
    this.userService.getCompanies().subscribe(data => {
      this.companies = data;
    })
  }

  findJobs() {console.log(this.debut)
    this.isLoading = true;
    this.userService.findJobs(this.company,this.debut,this.fin).subscribe(
      data => {
        console.log(data)
        this.jobs = data
        this.isLoading = false;
      }
    )
  }

  public downloadAsPDF() {
    const pages = document.querySelector('#pdfTable') as HTMLElement;
    const doc = new jsPDF({
      unit: 'px',
      format: [842, 1191]
    });

    doc.html(pages, {
      callback: (doc: jsPDF) => {
        //doc.deletePage(doc.getNumberOfPages());
        doc.save('pdf-export');
      }
    });

  }

}
