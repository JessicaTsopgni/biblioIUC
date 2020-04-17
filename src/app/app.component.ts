import { Component, OnInit } from '@angular/core';
import { Title } from '@angular/platform-browser';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent implements OnInit {
  appName = 'MyBiblio';
  title = 'biblioIUC';
  constructor(private pageTitle: Title) {

  }
  ngOnInit() {
    this.pageTitle.setTitle(this.appName + ' - Dashboard');
  }
}
