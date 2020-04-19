import { Component, OnInit } from '@angular/core';
import { AppSettings } from 'src/app/app.settings';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  constructor(private appService: AppSettings) { }

  ngOnInit() {
    this.appService.setTitlePage('Dashboard');
  }

}
