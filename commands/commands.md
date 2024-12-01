### Updated `commands.md` for Kubernetes with MySQL Commands Inside a Pod

# **Essential Kubernetes Commands**

## **Deployment Management**
- **Apply/Create a Deployment:**
  ```bash
  kubectl apply -f your-file.yml
  ```
  - Applies or creates resources defined in a YAML file.
  - Commonly used for deploying applications and configurations.

- **List Deployments:**
  ```bash
  kubectl get deployments
  ```
  - Lists all deployments in the current namespace.
  - Displays status, replicas, and availability.

- **Describe a Deployment:**
  ```bash
  kubectl describe deployment <deployment-name>
  ```
  - Provides detailed information about a specific deployment.
  - Useful for checking strategy, conditions, and recent events.

- **Delete a Deployment:**
  ```bash
  kubectl delete deployment <deployment-name>
  ```
  - Removes a deployment from the cluster.

- **Scale a Deployment:**
  ```bash
  kubectl scale deployment <deployment-name> --replicas=<number>
  ```
  - Adjusts the number of replicas for a deployment without modifying the YAML file.
  - Example: 
    ```bash
    kubectl scale deployment my-app --replicas=3
    ```

---

## **Pod Operations**
- **List Pods:**
  ```bash
  kubectl get pods
  ```
  - Lists all pods in the current namespace.
  - Displays status, age, and readiness.

- **Describe a Pod:**
  ```bash
  kubectl describe pod <pod-name>
  ```
  - Shows detailed information about a specific pod.
  - Helpful for troubleshooting and inspection.

- **Delete a Pod:**
  ```bash
  kubectl delete pod <pod-name>
  ```
  - Removes a specific pod from the cluster.
  - **Note:** Pods managed by a deployment will be recreated automatically.

- **Port Forward a Pod:**
  ```bash
  kubectl port-forward pod/<pod-name> <local-port>:<pod-port>
  ```
  - Forwards traffic from a local port to a port on the pod.
  - Example: 
    ```bash
    kubectl port-forward pod/mysql-pod 3306:3306
    ```

- **Access a Pod’s Shell (Bash):**
  ```bash
  kubectl exec -it <pod-name> -- /bin/bash
  ```
  - Opens an interactive bash shell inside a running pod.
  - Example:
    ```bash
    kubectl exec -it mysql-pod -- /bin/bash
    ```

- **Connect to MySQL Inside the Pod:**
  ```bash
  mysql -u root -h localhost -p
  ```
  - Connects to the MySQL database inside the pod using the root user.
  - After running this command, it will prompt you for the root password.
  - Example:
    ```bash
    mysql -u root -h localhost -p
    ```
    - **Note:** Use the same credentials as specified in the `MYSQL_ROOT_PASSWORD` environment variable in the deployment YAML file.

---

## **Service Management**
- **List Services:**
  ```bash
  kubectl get services
  ```
  - Lists all services in the current namespace.
  - Displays status, type, and cluster IP.

- **Expose a Deployment as a Service:**
  ```bash
  kubectl expose deployment <deployment-name> --type=<service-type> --name=<service-name> --port=<port>
  ```
  - Exposes a deployment as a service with the specified type (ClusterIP, NodePort, LoadBalancer).
  - Example: 
    ```bash
    kubectl expose deployment app-html-deployment --type=LoadBalancer --name=app-html --port=80
    ```

- **Get Service URL in Minikube:**
  ```bash
  minikube service --url <service-name>
  ```
  - Retrieves the external URL of a service running in Minikube.
  - Example: 
    ```bash
    minikube service --url app-html
    ```

- **Forward a Local Port to a Service Port:**
  ```bash
  kubectl port-forward service/<service-name> <local-port>:<service-port>
  ```
  - Forwards traffic from a local port to a Kubernetes service.
  - Example:
    ```bash
    kubectl port-forward service/nginx-loadbalancer-service 8080:80
    ```
  - **Usage:** Access the service locally using `http://localhost:8080`.

---

Let me know if you'd like any further modifications!

---

## **Node Management**
- **List Nodes:**
  ```bash
  kubectl get nodes
  ```
  - Lists all nodes in the cluster.
  - Displays status and Kubernetes version.

- **Describe a Node:**
  ```bash
  kubectl describe nodes <node-name>
  ```
  - Provides detailed information about a specific node.
  - Example: 
    ```bash
    kubectl describe nodes minikube
    ```

---

## **Minikube Commands**
- **Start Minikube:**
  ```bash
  minikube start
  ```
  - Starts the Minikube cluster.

- **Stop Minikube:**
  ```bash
  minikube stop
  ```
  - Stops the Minikube cluster.

- **Delete Minikube:**
  ```bash
  minikube delete
  ```
  - Deletes the Minikube cluster and all resources.

- **Check Minikube Status:**
  ```bash
  minikube status
  ```
  - Displays the status of the Minikube cluster and components.

---

## **Bonus Commands for Troubleshooting:**
- **View Logs of a Pod:**
  ```bash
  kubectl logs <pod-name>
  ```
  - Displays logs from a running pod.
  
- **Access a Pod’s Shell:**
  ```bash
  kubectl exec -it <pod-name> -- /bin/bash
  ```
  - Opens an interactive shell in a running pod.

- **Watch Resource Changes:**
  ```bash
  kubectl get pods --watch
  ```
  - Continuously updates the list of pods in real-time.

- **Delete All Resources:**
  ```bash
  kubectl delete all --all
  ```
  - Deletes all resources (deployments, pods, services, etc.) in the current namespace.

---

## **Docker Commands**
- **Build a Docker Image:**  
  ```bash
  docker build -t <image_name>:<tag> .
  ```
  - Builds a Docker image from the current directory's `Dockerfile`.
