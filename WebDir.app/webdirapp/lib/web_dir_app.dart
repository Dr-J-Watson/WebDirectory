import 'package:flutter/material.dart';

class WebDirApp extends StatefulWidget {
  const WebDirApp({super.key});

  @override
  State<WebDirApp> createState() => _WebDirAppState();
}

class _WebDirAppState extends State<WebDirApp> {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Web Directory',
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Ma liste de tâches'),
        ),
        body: Center(
          child: DirectoryMaster(),
        )
      ),
      theme: ThemeData(
        primarySwatch: Colors.yellow,
      ),
    );
  }
}