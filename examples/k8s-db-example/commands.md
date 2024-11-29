
# Kubernetes & Docker Commands for Backend and Database Deployment

This document provides all the commands and steps to set up and deploy the main application and MySQL database within Kubernetes, using Docker and Kubernetes resources.

## Directory Structure

```plaintext
/
├── app/
│   ├── src/
│   ├── Dockerfile          # Dockerfile for the application
│   ├── app-deployment.yml  # Kubernetes Deployment for the app
│
├── database/
│   ├── db-deployment.yml  # Kubernetes Deployment for MySQL
│   ├── Dockerfile         # Dockerfile to build the MySQL image
│   ├── init.sql           # SQL script to initialize the database
```

## 1. Build Docker Images

### 1.1 Building MySQL Image

Navigate to the `/database` folder and build the MySQL Docker image:

```bash
cd /database

docker build -t mysql-k8s:latest -f Dockerfile .
```

### 1.2 Building application Image

Navigate to the `/app` folder and build the App Docker image:

```bash
cd /app

docker build -t app-k8s:latest -f Dockerfile .
```

## 2. Deploy MySQL Database

### 2.1 Apply MySQL Deployment and Service

Navigate to the `/database` folder and apply the MySQL deployment and service YAML:

```bash
cd /database

kubectl apply -f db-deployment.yml
```

### 2.2 Verify MySQL Pod

Verify that the MySQL pod is running:

```bash
kubectl get pods
```

Ensure that the MySQL pod shows as `Running`.

## 3. Deploy App Application

### 3.1 Apply App Deployment and Service

Navigate to the `/app` folder and apply the application deployment and service YAML:

```bash
cd /app

kubectl apply -f app-deployment.yml
```

### 3.2 Verify App Pods

Verify that the App pods are running:

```bash
kubectl get pods
```

### 3.3 Port Forward App Service

To access the application in your browser, use port forwarding:

```bash
kubectl port-forward svc/app-service 8080:80
```

This command will forward port 8080 from your local machine to port 80 of the App service in the Kubernetes cluster. You can then access the App application by visiting:

```
http://localhost:8080
```

## 4. Troubleshooting

### 4.1 Checking Pod Logs

If you encounter any issues, check the logs of a specific pod:

```bash
kubectl logs <pod-name>
```

### 4.2 Scaling App Deployment

To scale the number of App replicas, use the following command:

```bash
kubectl scale deployment app-deployment --replicas=<desired-replica-count>
```

### 4.3.1 Deleting Pods

If you need to delete a pod, use:

```bash
kubectl delete pod <pod-name>
```

### 4.3.2 Delete All Resources

To delete all resources (deployments, pods, services, etc.) in the current namespace, use:

  ```bash
  kubectl delete all --all
  ```

---
