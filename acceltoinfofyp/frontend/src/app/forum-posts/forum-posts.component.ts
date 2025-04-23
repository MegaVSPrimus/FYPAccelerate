  import { Component, OnInit } from '@angular/core';
  import {DriverService} from '../services/driver.service';
  
  @Component({
    selector: 'app-forum-posts',
    templateUrl: './forum-posts.component.html',
    styleUrls: ['./forum-posts.component.css']
  })
  export class ForumComponent implements OnInit {
    drivers: any[] = [];

    constructor(private driverService: DriverService) {}

      
    ngOnInit(): void {
    }
  

/*
    isAdmin(): boolean {
      return this.authService.isAdmin();
    }
  
    deleteDriver(id: number): void {
      this.driverService.deleteDriver(id).subscribe(() => {
        this.getDrivers(); // Refresh the list after deletion
      });
    }*/
  }
  