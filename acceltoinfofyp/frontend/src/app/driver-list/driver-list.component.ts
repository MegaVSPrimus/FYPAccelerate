  import { Component, OnInit } from '@angular/core';
  import { DriverService } from '../services/driver.service';
  
  @Component({
    selector: 'app-drivers-list',
    templateUrl: './drivers-list.component.html',
    styleUrls: ['./drivers-list.component.css']
  })
  export class DriversComponent implements OnInit {
    drivers: any[] = [];

  
      
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
  