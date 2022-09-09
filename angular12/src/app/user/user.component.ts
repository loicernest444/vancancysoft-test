import { Component, OnInit } from '@angular/core';
import { Users, UserService } from '../user.service';
import { ElementRef, ViewChild } from '@angular/core';


import jsPDF from 'jspdf';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})

export class UserComponent implements OnInit {


  isLoading: boolean = true;
  users!: Users[];
  errorMessage!: string;
  page: number = 1;

  role!: string;
  profession!: string;
  division!: string;

  constructor(private userService: UserService) { }

  ngOnInit(): void {
    this.getUsers();
  }

  getUsers(){
    this.userService.getUsers().subscribe(data => {
      this.users = data;
      this.isLoading = false;
    })
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
